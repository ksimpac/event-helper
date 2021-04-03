<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'slogan', 'moreInfo', 'dateStart',
        'dateEnd', 'enrollDeadline', 'location',
        'maximum', 'type', 'poster', 'imageName'
    ];

    protected $primaryKey = 'event_id';

    public function limits()
    {
        return $this->hasMany(Limit::class, 'event_id', $this->primaryKey);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'event_id', $this->primaryKey);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'event_id');
    }
}
