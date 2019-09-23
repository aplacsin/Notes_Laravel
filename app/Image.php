<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function note()
    {
        return $this->belongsTo('App\Note', 'note_id', 'id');
    }
}
