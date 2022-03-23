<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    const ID = 'id';
    const TITLE = 'title';
    const OWNER_NAME = 'owner_name';
    const OWNER_MOBILE = 'owner_mobile';


    protected $fillable = [
        self::TITLE,
        self::OWNER_NAME,
        self::OWNER_MOBILE,
    ];

    public function people()
    {
        return $this->belongsToMany(People::class, GroupMember::class);
    }
}
