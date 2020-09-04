<?php

namespace App\Http\Controllers;

use App\Event;
use App\Exports\ParticipantExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
//use Barryvdh\Debugbar\Facade as Debugbar;

class AdminController extends Controller
{
    public function index() //show events
    {
        $type = Auth::user()->type;

        if($type == '系會') 
        {
            $events = DB::table('events')->where('poster', '系會')->orderBy('enrollDeadline', 'desc')->get();
        }
        else
        {
            $events = DB::table('events')->orderBy('enrollDeadline', 'desc')->get();
        }

        foreach ($events as $event)
        {
            $count = DB::table('participants')->where('event_id', $event->event_id)->count(); //計算該活動有多少人報名
            
            if($event->maximum != 0) {
                $event->count = $count;
            }
        }

        return view('admin.index', compact('events'));
    }

    public function register()
    {
        return Auth::user()->type == "系辦" ? view('admin.register') : abort(403);
    }

    public function store() //儲存建立的帳號
    {
        $regex_pattern = 'regex:/^\S*(?=\S{10,30})(?=\S*[a-z])(?=\S*[A-Z])(?![ ])\S*$/';

        $data = request()->validate([
            'account' => ['required', 'string', 'min:10', 'max:30', $regex_pattern, 'unique:users'],
            'type' => ['required'],
            'password' => ['required', 'string', 'min:10', 'max:30', $regex_pattern, 'confirmed'],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['realname'] = $data['type'];
        $data['created_at'] = now();
        $data['updated_at'] = $data['created_at'];

        DB::table('users')->insert($data);
        return redirect()->back()->with('successMsg', '帳號建立成功！');
    }

    public function export(Event $event) //輸出參加名單
    {
        return (new ParticipantExport)
                ->forEventId($event->event_id)
                ->download($event->title.'.xlsx');
    }
}
