<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function addTags($tags)
    {
        $this->tags()->syncWithoutDetaching($tags);
    }
}
