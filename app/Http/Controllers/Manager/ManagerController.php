<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function index()
    {
        $events = DB::table('events')->where('poster', '系會')->orderBy('enrollDeadline', 'desc')->get();

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
}
