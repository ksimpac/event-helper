<?php

namespace App\Classes;

use Carbon\Carbon;

class Card
{
    public static function sort($object)
    {
        $deadlineBeforeNowEvent = $object->filter(function ($value, $key) {
            $now = Carbon::now();
            return $value->enrollDeadline <= $now;
        });

        $deadlineAfterNowEvent = $object->filter(function ($value, $key) {
            $now = Carbon::now();
            return $value->enrollDeadline > $now;
        });

        $deadlineBeforeNowEvent = $deadlineBeforeNowEvent->sortByDesc(function ($value, $key) {
            return $value->enrollDeadline;
        });

        $deadlineAfterNowEvent = $deadlineAfterNowEvent->sortBy(function ($value, $key) {
            return $value->enrollDeadline;
        });

        return $deadlineAfterNowEvent->merge($deadlineBeforeNowEvent);
    }
}
