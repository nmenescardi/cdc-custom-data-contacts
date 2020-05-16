<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $guarded = [];

    public function contacts()
    {
        return $this->morphedByMany(Contact::class, 'taggable');
    }

    public function records()
    {
        return $this->morphedByMany(Record::class, 'taggable');
    }
}
