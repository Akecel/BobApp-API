<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileType extends Model 
{

    protected $table = 'files_types';
    public $timestamps = false;
    protected $fillable = array('title');

    public function folder_categorie()
    {
        return $this->belongsTo('App\Models\FolderCategorie');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }

}