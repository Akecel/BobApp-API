<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolderCategorie extends Model 
{

    protected $table = 'folders_categories';
    public $timestamps = false;
    protected $fillable = array('title');

    public function files_types()
    {
        return $this->hasMany('App\Models\FileType');
    }

}