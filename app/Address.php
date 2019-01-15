<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model 
{

    protected $table = 'address';
    public $timestamps = false;
    protected $fillable = array('address', 'postal_code', 'city', 'country');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}