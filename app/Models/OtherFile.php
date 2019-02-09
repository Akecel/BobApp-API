<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherFile extends Model
{
    protected $table = 'other_files';
    public $timestamps = false;
    protected $fillable = array('name','file_id');

    public function file()
    {
        return $this->belongTo('App\Models\File');
    }
}
