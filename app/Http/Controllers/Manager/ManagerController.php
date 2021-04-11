<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Event;
use App\Classes\DateTimeFormat;
use App\Classes\Card;

class ManagerController extends Controller
{
    public function index()
    {
        $events = Card::sort(Event::with('participants')->where('poster', '系會')
            ->orderBy('enrollDeadline', 'desc')->get());

        foreach ($events as $event) {
            $event->dateStart = DateTimeFormat::addWeekday(DateTimeFormat::removeSeconds($event->dateStart));
            $event->dateEnd = DateTimeFormat::addWeekday(DateTimeFormat::removeSeconds($event->dateEnd));
            $event->enrollDeadline = DateTimeFormat::addWeekday(DateTimeFormat::removeSeconds($event->enrollDeadline));
            $count = $event->participants->count(); //計算該活動有多少人報名

            if ($event->maximum != 0) {
                $event->count = $count;
            }
        }

        return view('admin.index', compact('events'));
    }
}
