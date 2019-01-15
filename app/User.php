<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{

    use Notifiable;

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = array('phone_number', 'email', 'admin');
    protected $hidden = array('password');

    public function userinfo()
    {
        return $this->hasOne('App\UserInfo');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function folders()
    {
        return $this->hasMany('App\Folder');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function filestypes()
    {
        return $this->hasManyThrough('App\FileType');
    }

}