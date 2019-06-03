<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'formats' => 'array'
    ];

    public function collections()
    {
        return $this->belongsToMany('App\Model\Collection', 'items_collection', 'book_id', 'collection_id');
    }
}
