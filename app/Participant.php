<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['event_id', 'identify', 'name', 'STU_ID'];
    protected $primaryKey = ['event_id', 'STU_ID'];
    public $incrementing = false;

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
