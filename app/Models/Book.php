<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function province()
    {
         return $this->belongsTo(Province::Class);
    }
}
