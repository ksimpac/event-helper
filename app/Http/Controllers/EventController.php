<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Library\AddInfoInEvent;
use Carbon\Carbon;
use Barryvdh\Debugbar\Facade as Debugbar;


class EventController extends Controller
{
    private $targets;
    private $types;

    public function __construct()
    {
        $this->targets = [
            "流管一1", "流管二1", "流管三1", "流管四1",
            "流管三A", "流管四A", "流管所研一", "流管所研二",
            "本系老師", "本校老師", "外校老師"
        ];

        $this->types = ["系辦", "系會", "校內", "校外"];
    }

    public function index($param = null)
    {

        $type = array("系辦", "系會", "校內", "校外");

        if (in_array($param, $type) == false && $param != null) abort(404);

        if ($param == null) {
            $events = DB::table('events')->orderBy('dateEnd', 'desc')->get();
        } else {
            $events = DB::table('events')->where('type', '=', $param)->orderBy('dateEnd', 'desc')->get();
        }

        foreach ($events as $event) {
            $event->dateStart = $this->dateTimeFormat($event->dateStart, "Add Week");
            $event->dateEnd = $this->dateTimeFormat($event->dateEnd, "Add Week");

            $count = DB::table('participants')->where('event_id', $event->event_id)->count(); //計算該活動有多少人報名

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
        $parts = DB::table('participants')->where('event_id', $event->event_id)->count();
        $tags = DB::table('tags')->where('event_id', $event->event_id)->get('name');
        $limits = DB::table('limits')->where('event_id', $event->event_id)->get('identify');
        $isSignUp = $this->isSignUp(Auth::id(), $event->event_id);
        $isAddInFavorite = $this->isAddInFavorite(Auth::id(), $event->event_id);
        $event->dateStartStr = $this->dateTimeFormat($event->dateStart, "Google Calendar");
        $event->dateEndStr = $this->dateTimeFormat($event->dateEnd, "Google Calendar");
        $event->dateStart = $this->dateTimeFormat($event->dateStart, "Add Week");
        $event->dateEnd = $this->dateTimeFormat($event->dateEnd, "Add Week");
        $event->enrollDeadline = $this->dateTimeFormat($event->enrollDeadline, "Add Week");

        return view('events.show', compact('parts', 'event', 'tags', 'limits', 'isSignUp', 'isAddInFavorite'));
    }

    public function store() //儲存活動
    {
        $data = $this->process(request());

        $event_id = DB::table('events')->insertGetId([
            'title' => $data['title'],
            'slogan' => $data['slogan'],
            'location' => $data['location'],
            'dateStart' => $data['dateStart'],
            'dateEnd' => $data['dateEnd'],
            'enrollDeadline' => $data['enrollDeadline'],
            'maximum' => $data['maximum'],
            'imageName' => $data['imageName'],
            'type' => $data['type'],
            'poster' => $data['poster'],
            'moreInfo' => $data['moreInfo'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);

        $this->tags_n_limit($data, $event_id);

        return redirect('/');
    }

    public function edit(Event $event) //編輯活動
    {
        $this->checkTypesPermission();
        $tags = DB::table('tags')->where('event_id', $event->event_id)->pluck('name')->toArray();
        $limits = DB::table('limits')->where('event_id', $event->event_id)->pluck('identify')->toArray();
        return view('events.edit', [
            'targets' => $this->targets,
            'types' => $this->types,
            'tags' => $tags,
            'event' => $event,
            'limits' => $limits
        ]);
    }

    public function update(Event $event) //更新活動
    {
        $data = $this->process(request(), $event);

        Storage::delete($event->imageName);

        DB::table('events')->where('event_id', $event->event_id)
            ->update([
                'title' => $data['title'],
                'slogan' => $data['slogan'],
                'location' => $data['location'],
                'dateStart' => $data['dateStart'],
                'dateEnd' => $data['dateEnd'],
                'enrollDeadline' => $data['enrollDeadline'],
                'maximum' => $data['maximum'],
                'type' => $data['type'],
                'poster' => $data['poster'],
                'moreInfo' => $data['moreInfo'],
                'updated_at' => $data['updated_at']
        ]);

        if(isset($data['imageName']))
        {
            DB::table('events')
                ->where('event_id', $event->event_id)
                ->update(['imageName' => $data['imageName']]);
        }



        $old_targets = DB::table('limits')->where('event_id', $event->event_id)->pluck('identify');
        $lists = $old_targets->diff($data['targets']);

        if($lists != null && $old_targets->count() >= count($data['targets']))
        {
            foreach($lists as $list)
            {
                DB::table('participants')
                    ->join('users', 'users.user_id', '=', 'participants.user_id')
                    ->where('users.identify', '=', $list)
                    ->delete();
            }
        }

        DB::table('tags')->where('event_id', $event->event_id)->delete();
        DB::table('limits')->where('event_id', $event->event_id)->delete();
        $this->tags_n_limit($data, $event->event_id);

        return redirect('/');
    }

    public function destroy(Event $event) //刪除活動
    {
        Storage::delete($event->imageName);
        DB::table('events')->where('event_id', $event->event_id)->delete();
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

        $data['poster'] = Auth::user()->type;
        $data['created_at'] = now();
        $data['updated_at'] = $data['created_at'];

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

    public function signup(Event $event, User $user) //使用者報名
    {
        $parts = DB::table('participants')->where('event_id', $event->event_id)->count();

        $user_id = $user->user_id;
        $created_at = now();
        $updated_at = $created_at;
        $isSignUp = $this->isSignUp($user_id, $event->event_id);

        if ((now() > date($event->enrollDeadline) || $parts >= $event->maximum && $event->maximum != 0) && !$isSignUp) //如果報名時間已截止或人數已額滿
        {
            return redirect()->back()->with("errorMsg", "報名時間已過或人數已額滿");
        }

        $isInLimit = DB::table('limits')
            ->where("identify", "=", $user->identify)
            ->where("event_id", "=", $event->event_id)->get()->isEmpty();

        if ($isInLimit) {
            return redirect()->back()->with("errorMsg", "您不符合報名資格，請確認您的身分是否符合活動對象的名單中");
        }

        if (!$isSignUp) {
            DB::table('participants')->insert([
                'event_id' => $event->event_id,
                'user_id' => $user_id,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]);
        } else {
            DB::table('participants')->where('event_id', $event->event_id)->where('user_id', $user_id)->delete();
        }

        return redirect()->back();
    }

    public function favorite(Event $event, User $user) //新增活動至該使用者的收藏
    {
        $user_id = $user->user_id;
        $created_at = now();
        $updated_at = $created_at;

        if (!$this->isAddInFavorite($user_id, $event->event_id)) {
            DB::table('collections')->insert([
                'event_id' => $event->event_id,
                'user_id' => $user_id,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]);
        } else {
            DB::table('collections')->where('event_id', $event->event_id)->where('user_id', $user_id)->delete();
        }

        return redirect()->back();
    }

    private function isSignUp($user_id, $event_id) //檢查使用者是否有報名活動
    {
        return !DB::table('participants')->where('user_id', $user_id)->where('event_id', $event_id)->get()->isEmpty();
    }

    private function isAddInFavorite($user_id, $event_id) //檢查使用者是否有將活動新增至自己的清單
    {
        return !DB::table('collections')->where('user_id', $user_id)->where('event_id', $event_id)->get()->isEmpty();
    }

    private function checkTypesPermission() //新增活動權限管理
    {
        if (Auth::user()->type == "系會") {
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

    private function tags_n_limit($data, $event_id)
    {

        $data['tags'] = explode(" ", $data['tags']);

        if($data['tags'][0] != "")
        {
            foreach ($data['tags'] as $tag) {
                DB::table('tags')->insert([
                    'event_id' => $event_id,
                    'name' => $tag,
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at']
                ]);
            }
        }

        foreach ($data['targets'] as $target) {
            DB::table('limits')->insert([
                'event_id' => $event_id,
                'identify' => $target,
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at']
            ]);
        }
    }
}
