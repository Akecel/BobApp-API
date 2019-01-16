<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;
use Session;

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
    protected $hidden = array('password', 'remember_token');

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


    public function sendToken()
    {
        $token = mt_rand(100000, 999999);
        Session::put('token', $token);
        $sid = $_ENV['TWILIO_ACCOUNT_SID'];
        $tokenTwillo = $_ENV['TWILIO_AUTH_TOKEN'];
        $client = new Client($sid, $tokenTwillo);
        /*
        $client->messages->create(
            $this->phone_number,
            array(
                'from' => $_ENV['TWILIO_NUMBER'],
                'body' => "Votre code secret est : " . $token
            )
        );*/

    }

    public function validateToken($token)
    {
        $validToken = Session::get('token');
        if($token == $validToken) {
            Session::forget('token');
            Session::forget('phone_number');
            Auth::login($this);
            return true;
        } else {
            return false;
        }
    }

}