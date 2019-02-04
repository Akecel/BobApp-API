<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileType extends Model 
{

    protected $table = 'files_types';
    public $timestamps = false;
    protected $fillable = array('title','folder_category_id');

    public function folder_category()
    {
        return $this->belongsTo('App\Models\FolderCategory');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }

}