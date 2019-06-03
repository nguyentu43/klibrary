<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $guarded = [];

    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'items_collection', 'collection_id', 'book_id')->withTimestamps();
    }
}
