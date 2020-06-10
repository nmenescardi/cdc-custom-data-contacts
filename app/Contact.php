<?php

namespace App;

use App\Traits\TaggableRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use TaggableRelationship, SoftDeletes;

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
