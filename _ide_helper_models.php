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
 * App\Admin
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUsername($value)
 */
	class Admin extends \Eloquent {}
}

namespace App{
/**
 * App\Carousel
 *
 * @property int $id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Carousel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carousel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carousel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Carousel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carousel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carousel wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carousel whereUpdatedAt($value)
 */
	class Carousel extends \Eloquent {}
}

namespace App{
/**
 * App\Class_name
 *
 * @property int $sno
 * @property string $DEP_ID
 * @property string $SCH_DEP
 * @property string $CID
 * @property string $SCH_TYPE
 * @property string $DEP_ABBR
 * @property string $DEP_NAME
 * @property string $class_no
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name query()
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name whereCID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name whereClassNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name whereDEPABBR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name whereDEPID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name whereDEPNAME($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name whereSCHDEP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name whereSCHTYPE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Class_name whereSno($value)
 */
	class Class_name extends \Eloquent {}
}

namespace App{
/**
 * App\Collection
 *
 * @property int $event_id
 * @property string $STU_ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Collection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Collection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Collection query()
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereSTUID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Collection whereUpdatedAt($value)
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
 * App\Manager
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Manager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manager query()
 * @method static \Illuminate\Database\Eloquent\Builder|Manager whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manager wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manager whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Manager whereUsername($value)
 */
	class Manager extends \Eloquent {}
}

namespace App{
/**
 * App\Participant
 *
 * @property int $event_id
 * @property string $STU_ID
 * @property string $identify
 * @property string $NAME
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereIdentify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereNAME($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereSTUID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUpdatedAt($value)
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

