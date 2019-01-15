<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model 
{

    protected $table = 'folders';
    public $timestamps = true;
    protected $fillable = array('name');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function files()
    {
        return $this->belongsToMany('App\File');
    }

}