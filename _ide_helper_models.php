<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Collection
 *
 * @property int $event_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Collection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Collection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Collection query()
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereUserId($value)
 */
	class Collection extends \Eloquent {}
}

namespace App{
/**
 * App\Event
 *
 * @property int $event_id
 * @property string $title
 * @property string $slogan
 * @property string $moreInfo
 * @property string $dateStart
 * @property string $dateEnd
 * @property string $enrollDeadline
 * @property string $location
 * @property int $maximum
 * @property string $imageName
 * @property string $type
 * @property string $poster
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Limit[] $limits
 * @property-read int|null $limits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Participant[] $participants
 * @property-read int|null $participants_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEnrollDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereImageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereMaximum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereMoreInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePoster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSlogan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 */
	class Event extends \Eloquent {}
}

namespace App{
/**
 * App\Limit
 *
 * @property int $event_id
 * @property string $identify
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder|Limit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Limit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Limit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Limit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Limit whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Limit whereIdentify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Limit whereUpdatedAt($value)
 */
	class Limit extends \Eloquent {}
}

namespace App{
/**
 * App\Participant
 *
 * @property int $event_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Event $event
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUserId($value)
 */
	class Participant extends \Eloquent {}
}

namespace App{
/**
 * App\Tag
 *
 * @property int $event_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $user_id
 * @property string $account
 * @property string $password
 * @property string|null $std_id
 * @property string|null $realname
 * @property string|null $telephone
 * @property string|null $identify
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property int $point
 * @property string $type
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Collection[] $collections
 * @property-read int|null $collections_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Participant[] $participants
 * @property-read int|null $participants_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdentify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRealname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserId($value)
 */
	class User extends \Eloquent {}
}

