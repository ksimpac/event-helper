<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Event;
use App\Exports\ParticipantExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Admin;
use App\Manager;

class AdminController extends Controller
{
    public function index() //show events
    {
        $events = DB::table('events')->orderBy('enrollDeadline', 'desc')->get();

        foreach ($events as $event) {

            $event->dateStart = $this->dateTimeFormat($event->dateStart, "Add Week");
            $event->dateEnd = $this->dateTimeFormat($event->dateEnd, "Add Week");

            $count = DB::table('participants')->where('event_id', $event->event_id)->count(); //計算該活動有多少人報名

            if ($event->maximum != 0) {
                $event->count = $count;
            }
        }

        return view('admin.index', compact('events'));
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function store() //儲存建立的帳號
    {
        $regex_pattern = 'regex:/^\S*(?=\S{10,30})(?=\S*[a-z])(?=\S*[A-Z])(?![ ])\S*$/';

        $data = request()->validate([
            'username' => ['required', 'string', 'min:10', 'max:30', $regex_pattern, 'unique:users'],
            'type' => ['required'],
            'password' => ['required', 'string', 'min:10', 'max:30', $regex_pattern, 'confirmed'],
        ]);

        if ($data['type'] == '系辦') {
            Admin::create([
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
            ]);
        }

        if ($data['type'] == '系會') {
            Manager::create([
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
            ]);
        }

        return redirect()->back()->with('successMsg', '帳號建立成功！');
    }

    public function export(Event $event) //輸出參加名單
    {
        return (new ParticipantExport)
            ->forEventId($event->event_id)
            ->download($event->title . '.xlsx');
    }

    private function dateTimeFormat($dateString, $option)
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
}
