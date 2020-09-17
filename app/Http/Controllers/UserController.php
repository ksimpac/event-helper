<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
//use Barryvdh\Debugbar\Facade as Debugbar;
use Carbon\Carbon;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {

        if (request()->input('telephone') !== $user->telephone) {
            $data = request()->validate([
                'telephone' => ['required', 'size:10', 'unique:users']
            ]);
            $user->update($data);
        }

        if (request()->input('email') !== $user->email) {
            $data = request()->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
            $user->update($data);
            //$user->sendEmailVerificationNotification(); //重送驗證信件
        }


        return redirect()->back();
    }

    public function show(User $user)
    {
        $participants = DB::table('events')
            ->join('participants', 'events.event_id', '=', 'participants.event_id')
            ->where('user_id', $user->user_id)->get();

        foreach ($participants as $participant) {
            $participant->dateStart = $this->dateTimeFormat($participant->dateStart, "Add Week");
            $participant->dateEnd = $this->dateTimeFormat($participant->dateEnd, "Add Week");
        }

        $collections = DB::table('events')
            ->join('collections', 'events.event_id', '=', 'collections.event_id')
            ->where('user_id', $user->user_id)->get();

        foreach ($collections as $collection) {
            $collection->dateStart = $this->dateTimeFormat($collection->dateStart, "Add Week");
            $collection->dateEnd = $this->dateTimeFormat($collection->dateEnd, "Add Week");
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
