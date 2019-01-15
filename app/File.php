<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model 
{

    protected $table = 'files';
    public $timestamps = true;
    protected $fillable = array('url');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function folders()
    {
        return $this->belongsToMany('App\Folder');
    }

    public function filetype()
    {
        return $this->belongsTo('App\FileType');
    }

}