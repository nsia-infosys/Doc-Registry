<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function province()
    {
         return $this->belongsTo(Province::Class);
    }
    // protected $fillable = ['book_name'];
    protected $fillable = ['book_name', 'book_type_id', 'province_id','volume_no','start_page_no',
    'end_page_no','user_id','district_id','book_year','keywords','total_pages','remarks'];
}
