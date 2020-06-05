<?php

namespace App\Traits;

use App\Tag;

trait TaggableRelationship
{

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function addTags($tagList)
    {
        $this->tags()->syncWithoutDetaching($tagList);
    }
}
