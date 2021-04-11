<?php

namespace App\Classes;

use Carbon\Carbon;

class DateTimeFormat
{
    public static function addWeekday($dateString)
    {
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
        return $date[0] . "(" . $weekMap[$dayOfTheWeek] . ") " . $date[1];
    }

    public static function convertToGoogleCalendarFormat($dateString)
    {
        return Carbon::parse($dateString)->format("Ymd") . "T" . Carbon::parse($dateString)->format("His") . "Z";
    }

    public static function removeSeconds($dateString)
    {
        return Carbon::parse($dateString)->format("Y-m-d H:i");
    }

    public static function getUTCDateTime($dateString)
    {
        return Carbon::parse($dateString)->subHours(8)->format("Y-m-d H:i:s");
    }
}
