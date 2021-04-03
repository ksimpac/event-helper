<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Participant;
use App\Collection;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function show($STU_ID)
    {
        $participants = Participant::with('event')->where('STU_ID', $STU_ID)->get();

        foreach ($participants as $participant) {
            $participant->event->dateStart = $this->dateTimeFormat($participant->event->dateStart, "Add Week");
            $participant->event->dateEnd = $this->dateTimeFormat($participant->event->dateEnd, "Add Week");
        }

        $collections = Collection::with('event')->where('STU_ID', $STU_ID)->get();

        foreach ($collections as $collection) {
            $collection->event->dateStart = $this->dateTimeFormat($collection->event->dateStart, "Add Week");
            $collection->event->dateEnd = $this->dateTimeFormat($collection->event->dateEnd, "Add Week");
        }

        return view('users.show', compact('participants', 'collections'));
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
