<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $guarded = [];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function addTags($tagList)
    {
        $this->tags()->syncWithoutDetaching($tagList);
    }
}
