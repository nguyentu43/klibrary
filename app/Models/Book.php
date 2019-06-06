<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'formats' => 'array',
        'cover' => 'boolean',
        'date' => 'datetime:Y-m-d H:i:s'
    ];

    public function collections()
    {
        return $this->belongsToMany('App\Models\Collection', 'items_collection', 'book_id', 'collection_id');
    }
}
