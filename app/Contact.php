<?php

namespace App;

use App\Traits\TaggableRelationship;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use TaggableRelationship;

    protected $guarded = [];

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('inactive', false);
    }
}
