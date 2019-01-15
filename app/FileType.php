<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileType extends Model 
{

    protected $table = 'files_types';
    public $timestamps = false;
    protected $fillable = array('name');

    public function foldercategorie()
    {
        return $this->belongsTo('App\FolderCategorie');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

}