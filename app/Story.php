<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TaggableRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use TaggableRelationship, SoftDeletes;

    protected $guarded = [];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
