<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Limit extends Model
{
    protected $fillable = ['event_id', 'identify'];
    protected $primaryKey = 'event_id';
    public $incrementing = false;

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
