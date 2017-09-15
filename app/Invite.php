<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    /**
    * The name of the "created at" column.
    *
    * @var string
    */
    const CREATED_AT = 'send_at';

    /**
    * The name of the "updated at" column.
    *
    * @var string
    */
    const UPDATED_AT = 'updated_at';

    public $timestamps = false;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'reason',
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'token',
    ];
}
