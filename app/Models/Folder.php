<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model 
{

    protected $table = 'folders';
    public $timestamps = true;
    protected $fillable = array('user_id','title');

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function files()
    {
        return $this->belongsToMany('App\Models\File');
    }
    

}