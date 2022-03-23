<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupMember extends Model
{
    use HasFactory;

    const GROUP_ID = 'group_id';
    const PEOPLE_ID = 'people_id';

    protected $fillable = [
        self::GROUP_ID,
        self::PEOPLE_ID
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }


    public function people()
    {
        return $this->hasOne(People::class, 'id', 'people_id');
    }
}
