<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Event;
use App\Classes\DateTimeFormat;
use App\Classes\Card;

class AdminController extends Controller
{
    public function index() //show events
    {
        $events = Card::sort(Event::with('participants')->orderBy('enrollDeadline', 'desc')->get());

        foreach ($events as $event) {
            $event->dateStart = DateTimeFormat::parse($event->dateStart, "Add Week");
            $event->dateEnd = DateTimeFormat::parse($event->dateEnd, "Add Week");
            $event->enrollDeadline = DateTimeFormat::parse($event->enrollDeadline, "Add Week");
            $count = $event->participants->count(); //計算該活動有多少人報名

            if ($event->maximum != 0) {
                $event->count = $count;
            }
        }

        return view('admin.index', compact('events'));
    }
}
