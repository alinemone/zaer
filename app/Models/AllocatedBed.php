<?php

namespace App\Models;

use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use App\Infrustructure\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AllocatedBed extends Model
{
    use SoftDeletes, Filterable;

    const ID = 'id';
    const PLACE_ID = 'place_id';
    const ROOM_ID = 'room_id';
    const BED_ID = 'bed_id';
    const PEOPLE_ID = 'people_id';
    const PEOPLE_TYPE = 'people_type';
    const REFERRER_USER = 'referrer_user';
    const START_AT = 'start_at';
    const EXPIRED_AT = 'expired_at';
    const CREATED_BY = 'created_by';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        self::PEOPLE_ID,
        self::PEOPLE_TYPE,
        self::REFERRER_USER,
        self::PLACE_ID,
        self::ROOM_ID,
        self::BED_ID,
        self::START_AT,
        self::EXPIRED_AT,
        self::CREATED_BY,
        self::DELETED_AT
    ];

    protected $casts = [
        self::PEOPLE_ID  => 'int',
        self::PLACE_ID   => 'int',
        self::ROOM_ID    => 'int',
        self::BED_ID     => 'int',
        self::CREATED_BY => 'int',
    ];

    protected $dates = [
        self::START_AT,
        self::EXPIRED_AT,
        self::DELETED_AT,
    ];

    /**
     * @var string[]
     */
    protected $filters = [
        'name',
        'mobile',
        'place',
        'room',
        'bed',
        'people',
        'start_at',
        'expired_at',
        'birthday',
        'country',
        'province',
        'degree',
    ];


    public function place()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }

    /**
     * @return BelongsTo
     */
    public function people(): BelongsTo
    {
        return $this->belongsTo(People::class);
    }

    public function servant()
    {
        return $this->belongsTo(Servant::class,'people_id','id');
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class, 'bed_id', 'id');
    }

    /**
     * @param $value
     * @return string
     */
    public function getStartAtAttribute($value)
    {
        return jdate($value)->format('Y/m/d');
    }

    /**
     * @param $value
     * @return string
     */
    public function setStartAtAttribute($value)
    {
        $date = explode('/', $value);

        return $this->attributes[self::START_AT] = (new Jalalian($date[0], $date[1], $date[2]))
            ->toCarbon()
            ->toDate();
    }

    /**
     * @param $value
     * @return string
     */
    public function setExpiredAtAttribute($value)
    {
        $date = explode('/', $value);

        return $this->attributes[self::EXPIRED_AT] = (new Jalalian($date[0], $date[1], $date[2]))
            ->toCarbon()
            ->toDate();
    }

    /**
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return jdate($value)->format('Y/m/d');
    }

    /**
     * @param $value
     * @return string
     */
    public function getExpiredAtAttribute($value)
    {
        return jdate($value)->format('Y/m/d');
    }


    public function scopePlace($query, $value)
    {
        return $query->where('places.id', $value);
    }

    public function scopeRoom($query, $value)
    {
        return $query->where('rooms.id', $value);
    }

    public function scopeBed($query, $value)
    {
        return $query->where('beds.id', $value);
    }

    public function scopeCountry($query, $value)
    {
        return $query->where('country', $value);
    }

    public function scopeProvince($query, $value)
    {
        return $query->where('province', $value);
    }

    public function scopeCity($query, $value)
    {
        return $query->where('people.city', $value);
    }


    public function scopeBirthday($query, $value)
    {

        return $query->where('people.birthday',$value);
    }

    public function scopeStart_at($query, $value)
    {
        return $query->where('allocated_beds.start_at', $value);
    }

    public function scopeExpired_at($query, $value)
    {
        return $query->where('allocated_beds.expired_at', $value);
    }

    public function scopeDegree($query, $value)
    {
        return $query->where('degree', $value);
    }

    public function scopeName($query, $value)
    {
        return $query->where(
             'people.name_family',
            'like',
            '%' . str_replace(' ', '%', $value) . '%'
        );
    }

    public function scopeMobile($query, $value)
    {
        return $query->where('people.mobile', $value);
    }

}
