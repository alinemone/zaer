<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use SoftDeletes;

    const ID = 'id';
    const NAME_FAMILY = 'name_family';
    const NATIONAL_CODE = 'national_code';
    const MOBILE = 'mobile';
    const BIRTHDAY = 'birthday';
    const GENDER = 'gender';
    const COUNTRY = 'country';
    const CITY = 'city';
    const PROVINCE = 'province';
    const DEGREE = 'degree';
    const JOB = 'job';
    const HOW_TO = 'how_to';
    const DELETED_AT = 'deleted_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::NAME_FAMILY,
        self::NATIONAL_CODE,
        self::BIRTHDAY,
        self::COUNTRY,
        self::GENDER,
        self::CITY,
        self::PROVINCE,
        self::DEGREE,
        self::JOB,
        self::MOBILE,
        self::HOW_TO,
        self::DELETED_AT,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    protected $dates = [
        self::BIRTHDAY,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];

    /**
     * @param $value
     * @return \Carbon\Carbon
     */
    public function setBirthdayAttribute($value)
    {
        return $this->attributes[self::BIRTHDAY] = jalali_to_carbon($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getBirthdayAttribute($value)
    {
        return jdate($value)->format('Y/m/d');
    }

    public function allocatedBed()
    {
        return $this->hasOne(AllocatedBed::class);
    }

    public function latestAllocatedBed()
    {
        return $this->allocatedBed()
            ->where(AllocatedBed::PEOPLE_TYPE, People::class)
            ->whereDate(
                AllocatedBed::EXPIRED_AT,
                '>=',
                now()->subDays(getSetting('min_clearance_day_ago'))
            )
            ->latest(AllocatedBed::EXPIRED_AT);
    }

    public function group()
    {
        return $this->belongsToMany(group::class);
    }
}
