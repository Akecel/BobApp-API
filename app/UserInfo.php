<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model 
{

    protected $table = 'user_info';
    public $timestamps = true;
    protected $fillable = array('user_id','lastName', 'firstName', 'birthdate');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}