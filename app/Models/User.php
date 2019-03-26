<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;
use Session;

class User extends Authenticatable
{

    use HasApiTokens, Notifiable;

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = array('phone_number', 'email', 'admin','lastName', 'firstName', 'birthdate','address', 'postal_code', 'city', 'country','password');
    protected $hidden = array('remember_token');

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }

    public function folders()
    {
        return $this->hasMany('App\Models\Folder');
    }

    public function filestypes()
    {
        return $this->hasManyThrough('App\Models\FileType');
    }


    public function sendToken()
    {
        $token = mt_rand(100000, 999999);
        Session::put('token', $token);
        $sid = config('app.twilio_sid');
        $tokenTwillo = config('app.twilio_token');
        $client = new Client($sid, $tokenTwillo);
        /*
        $client->messages->create(
            $this->phone_number,
            array(
                'from' => config('app.twilio_number'),
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
            return true;
        } else {
            return false;
        }
    }

}