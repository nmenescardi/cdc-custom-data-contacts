<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TaggableRelationship;

class Story extends Model
{
    use TaggableRelationship;

    protected $guarded = [];
}
