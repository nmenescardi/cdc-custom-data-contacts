<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function contacts()
    {
        return $this->morphedByMany(Contact::class, 'taggable');
    }

    public function records()
    {
        return $this->morphedByMany(Record::class, 'taggable');
    }

    public function stories()
    {
        return $this->morphedByMany(Story::class, 'taggable');
    }

    public static function addTags($tagList)
    {
        foreach ($tagList ?? [] as $tag) {
            Tag::updateOrCreate([
                'name' => $tag
            ]);
        }
    }
}
