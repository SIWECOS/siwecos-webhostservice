<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bugreport extends Model
{
    /**
    * The name of the "created at" column.
    *
    * @var string
    */
    const CREATED_AT = 'created_at';

    /**
    * The name of the "updated at" column.
    *
    * @var string
    */
    const UPDATED_AT = 'updated_at';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'application', 'version', 'signedemail', 'exploittype', 'vulnerability',
        'filterdescription', 'modsecurityrules', 'plaintextrules', 'infourl', 'filterable', 'cveids'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = ['token',];

    protected $casts = [
        'modsecurityrules' => 'array',
        'plaintextrules' => 'array',
        'cveids' => 'array',
        'exploittype' => 'int',
        'application' => 'int'
    ];
}
