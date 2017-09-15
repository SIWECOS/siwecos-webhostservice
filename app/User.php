<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USERROLE_ISP = 1;
    const USERROLE_CMSSECURITY = 2;
    const USERROLE_CMSGARDEN = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if this user is a Internet service provider
     */
    public function isISP()
    {
        return $this->role == self::USERROLE_ISP;
    }

    /**
     * Check if this user is a CMS security guy (or girl)
     */
    public function isCMSSecurity()
    {
        return $this->role == self::USERROLE_CMSSECURITY;
    }

    /**
     * Check if this user is a CMS security guy (or girl)
     */
    public function isCMSGarden()
    {
        return $this->role == self::USERROLE_CMSGARDEN;
    }
}
