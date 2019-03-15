<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolderCategory extends Model 
{

    protected $table = 'folders_categories';
    public $timestamps = false;
    protected $fillable = array('title','icon');

    public function files_types()
    {
        return $this->hasMany('App\Models\FileType');
    }

}