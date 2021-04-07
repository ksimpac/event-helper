<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Participant;
use App\Tag;
use App\Limit;
use App\Collection;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Exports\ParticipantExport;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{
    private $targets;
    private $types;

    public function __construct()
    {
        $this->targets = [
            "流管一1", "流管二1", "流管三1", "流管四1",
            "流管三A", "流管四A", "流管所研一", "流管所研二",
        ];

        $this->types = ["系辦", "系會", "校內", "校外"];
    }

    public function index($param = null)
    {
        //$type = array("系辦", "系會", "校內", "校外");

        if (in_array($param, $this->types) == false && $param != null) abort(404);

        if ($param == null) {
            $events = Event::with('participants')->orderBy('dateEnd', 'desc')->get();
        } else {
            $events = Event::with('participants')->where('type', '=', $param)
                ->orderBy('dateEnd', 'desc')->get();
        }

        foreach ($events as $event) {
            $event->dateStart = $this->dateTimeFormat($event->dateStart, "Add Week");
            $event->dateEnd = $this->dateTimeFormat($event->dateEnd, "Add Week");
            $count = $event->participants->count(); //計算該活動有多少人報名

            if (date('Y-m-d H:i:s', strtotime($event->enrollDeadline)) <= date('Y-m-d H:i:s')) {
                $event->status = "已截止";
                continue;
            }

            if ($event->maximum != 0) {
                $event->count = $count;

                if ($count == $event->maximum) {
                    $event->status = "已額滿";
                    continue;
                }
            }

            $event->status = "開放報名中";
        }

        $param = $param ?? "最新";

        return view('events.index', compact('events', 'param'));
    }

    public function create() //新增活動
    {
        $this->checkTypesPermission();
        return view('events.create', ['targets' => $this->targets, 'types' => $this->types]);
    }

    public function show(Event $event) //顯示活動資訊
    {
        $parts = Participant::where('event_id', $event->event_id)->count();
        $tags = Tag::where('event_id', $event->event_id)->get('name');
        $limits = Limit::where('event_id', $event->event_id)->get('identify');
        $isSignUp = $this->isSignUp(Auth::id(), $event->event_id);
        $isAddInFavorite = $this->isAddInFavorite(Auth::id(), $event->event_id);
        $event->dateStartStr = $this->dateTimeFormat($event->dateStart, "Google Calendar");
        $event->dateEndStr = $this->dateTimeFormat($event->dateEnd, "Google Calendar");
        $event->dateStart = $this->dateTimeFormat($event->dateStart, "Add Week");
        $event->dateEnd = $this->dateTimeFormat($event->dateEnd, "Add Week");
        $event->enrollDeadline = $this->dateTimeFormat($event->enrollDeadline, "Add Week");

        return view('events.show', compact('parts', 'event', 'tags', 'limits', 'isSignUp', 'isAddInFavorite'));
    }

    public function store(Request $request) //儲存活動
    {
        $data = $this->process($request);
        $event_id = Event::create($data)->event_id;
        $this->tags($data, $event_id);
        $this->limits($data, $event_id);
        return redirect('/');
    }

    public function edit(Event $event) //編輯活動
    {
        $this->checkTypesPermission();
        $tags = Tag::where('event_id', $event->event_id)->pluck('name')->toArray();
        $limits = Limit::where('event_id', $event->event_id)->pluck('identify')->toArray();
        return view('events.edit', [
            'targets' => $this->targets,
            'types' => $this->types,
            'tags' => $tags,
            'event' => $event,
            'limits' => $limits
        ]);
    }

    public function update(Event $event, Request $request) //更新活動
    {
        $data = $this->process($request, $event);
        $tags = $data['tags'];
        $targets = $data['targets'];
        unset($data['tags'], $data['targets']);

        if (isset($data['indexImage'])) Storage::delete($event->imageName);
        Event::where('event_id', $event->event_id)->update($data);

        $old_targets = Limit::where('event_id', $event->event_id)->pluck('identify');
        $lists = $old_targets->diff($targets);

        if ($lists != null && $old_targets->count() >= count($targets)) {
            Participant::with('event')
                ->where('event_id', $event->event_id)
                ->whereIn('identify', $lists)->delete();
        }

        Tag::where('event_id', $event->event_id)->delete();
        Limit::where('event_id', $event->event_id)->delete();
        $this->tags($tags, $event->event_id);
        $this->limits($targets, $event->event_id);

        return redirect('/');
    }

    public function destroy(Event $event) //刪除活動
    {
        Storage::delete($event->imageName);
        Event::where('event_id', $event->event_id)->delete();
        return redirect()->back();
    }

    private function process(Request $request, Event $event = null) //資料驗證及處理
    {
        $data = $request->validate([
            'indexImage' => isset($event) ? ['image', 'mimes:jpeg,jpg,png', 'max:1024'] : ['required', 'image', 'mimes:jpeg,jpg,png', 'max:1024'],
            'title' => ['required', 'max:100'],
            'slogan' => ['required', 'max:100'],
            'location' => ['required', 'max:100'],
            'dateStart' => ['required', 'date_format:Y-m-d H:i', 'after:date'],
            'dateEnd' => ['required', 'date_format:Y-m-d H:i', 'after:dateStart'],
            'enrollDeadline' => ['required', 'date_format:Y-m-d H:i', 'after:date', 'before:dateStart'],
            'maximum' => ['required', 'integer', 'min:0'],
            'targets' => ['required', 'array'],
            'type' => ['required'],
        ]);

        if (Auth::guard('admin')->check()) {
            $data['poster'] = '系辦';
        }

        if (Auth::guard('manager')->check()) {
            $data['poster'] = '系會';
        }

        /**
         * Purifier is a anti XSS attack tool
         */

        $data['moreInfo'] = Purifier::clean($request->moreInfo);
        $data['tags'] = str_replace("  ", " ", $request->tags);

        if (isset($data['indexImage'])) $this->storeImage($request, $data);

        return $data;
    }

    private function storeImage(Request $request, &$data) //圖片儲存
    {
        $path = $request->indexImage->store('image/index', 'public');
        $fileName = substr($path, strlen('image/index/'));
        $data['imageName'] = $fileName;
        $this->imageResize($fileName);
    }

    private function imageResize($fileName) //調整首頁縮圖
    {
        $img = Image::make(public_path('/storage/image/index/') . $fileName);
        $img->resize(300, 107)->save(public_path('/storage/image/index/') . $fileName);
    }

    public function signup(Event $event, $STU_ID) //使用者報名
    {
        $parts = Participant::where('event_id', $event->event_id)->count();
        $isSignUp = $this->isSignUp($STU_ID, $event->event_id);

        if ((now() > date($event->enrollDeadline) || $parts >= $event->maximum && $event->maximum != 0) && !$isSignUp) //如果報名時間已截止或人數已額滿
        {
            return redirect()->back()->with("errorMsg", "報名時間已過或人數已額滿");
        }

        $isInLimit = Limit::where("identify", "=", Auth::user()->identify)
            ->where("event_id", "=", $event->event_id)->get()->isEmpty();

        if ($isInLimit) {
            return redirect()->back()->with("errorMsg", "您不符合活動對象之內的報名資格");
        }

        if (!$isSignUp) {
            Participant::create([
                'event_id' => $event->event_id,
                'STU_ID' => $STU_ID,
                'identify' => Auth::user()->identify,
                'NAME' => Auth::user()->NAME,
            ]);
        } else {
            Participant::where('event_id', $event->event_id)->where('STU_ID', $STU_ID)->delete();
        }

        return redirect()->back();
    }

    public function favorite(Event $event, $STU_ID) //新增活動至該使用者的收藏
    {
        if (!$this->isAddInFavorite($STU_ID, $event->event_id)) {
            Collection::create([
                'event_id' => $event->event_id,
                'STU_ID' => $STU_ID,
            ]);
        } else {
            Collection::where('event_id', $event->event_id)->where('STU_ID', $STU_ID)->delete();
        }

        return redirect()->back();
    }

    public function export(Event $event) //輸出參加名單
    {
        return Excel::download(new ParticipantExport($event->event_id), $event->title . '.xlsx');
    }

    private function isSignUp($STU_ID, $event_id) //檢查使用者是否有報名活動
    {
        return !Participant::where('STU_ID', $STU_ID)->where('event_id', $event_id)->get()->isEmpty();
    }

    private function isAddInFavorite($STU_ID, $event_id) //檢查使用者是否有將活動新增至自己的清單
    {
        return !Collection::where('STU_ID', $STU_ID)->where('event_id', $event_id)->get()->isEmpty();
    }

    private function checkTypesPermission() //新增活動權限管理
    {
        if (Auth::guard('manager')->check()) {
            $key = array_search("系辦", $this->types);
            unset($this->types[$key]);
        }
    }

    private function dateTimeFormat($dateString, $option) //時間格式
    {
        if ($option == "Add Week") {
            $weekMap = [
                0 => '日',
                1 => '一',
                2 => '二',
                3 => '三',
                4 => '四',
                5 => '五',
                6 => '六',
            ];

            $dayOfTheWeek = Carbon::parse($dateString)->dayOfWeek;
            $date = explode(" ", $dateString);
            return $date[0] . "(" . $weekMap[$dayOfTheWeek] . ") " . substr($date[1], 0, 5);
        }

        if ($option == "Google Calendar") {
            /**
             * 因為Google Calendar會自動將輸入時間格式轉成使用者所在時區的時間，故要先減掉8小時
             */
            return Carbon::parse($dateString)->format("Ymd") . "T" . Carbon::parse($dateString)->subHours(8)->format("His") . "Z";
        }
    }

    private function tags($data, $event_id)
    {
        if ($data == "") return;
        $tags = explode(" ", $data);

        foreach ($tags as $tag) {
            Tag::create([
                'event_id' => $event_id,
                'name' => $tag,
            ]);
        }
    }

    private function limits($data, $event_id)
    {
        foreach ($data as $target) {
            Limit::create([
                'event_id' => $event_id,
                'identify' => $target,
            ]);
        }
    }
}
