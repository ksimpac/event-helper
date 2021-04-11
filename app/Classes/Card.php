<?php

namespace App\Classes;

use Carbon\Carbon;

class Card
{
    public static function sort($object)
    {
        $now = Carbon::now();

        $deadlineHasExpiredEvent = $object->filter(function ($value) use ($now) {
            return $value->enrollDeadline <= $now;
        });

        $deadlineHasNotExpiredEvent = $object->filter(function ($value) use ($now) {
            return $value->enrollDeadline > $now;
        });

        $deadlineHasExpiredEvent = $deadlineHasExpiredEvent->sortByDesc(function ($value) {
            return $value->enrollDeadline;
        });

        $deadlineHasNotExpiredEvent = $deadlineHasNotExpiredEvent->sortBy(function ($value) {
            return $value->enrollDeadline;
        }); //Sorting event depanding on which enrollDeadline close to now

        return $deadlineHasNotExpiredEvent->merge($deadlineHasExpiredEvent);
    }
}
