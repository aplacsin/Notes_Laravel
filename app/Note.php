<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title', 'content'
    ]; 
    
    public function image()
    {
        return $this->hasMany('App\Image');
    }
}
