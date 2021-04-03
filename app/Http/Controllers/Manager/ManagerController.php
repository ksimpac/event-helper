<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Event;

class ManagerController extends Controller
{
    public function index()
    {
        $events = Event::with('participants')->where('poster', '系會')
            ->orderBy('enrollDeadline', 'desc')->get();

        foreach ($events as $event) {
            $event->dateStart = $this->dateTimeFormat($event->dateStart, "Add Week");
            $event->dateEnd = $this->dateTimeFormat($event->dateEnd, "Add Week");
            $count = $event->participants->count(); //計算該活動有多少人報名

            if ($event->maximum != 0) {
                $event->count = $count;
            }
        }

        return view('admin.index', compact('events'));
    }
}
