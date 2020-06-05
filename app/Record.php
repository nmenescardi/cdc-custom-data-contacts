<?php

namespace App;

use App\Traits\TaggableRelationship;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use TaggableRelationship;

    protected $guarded = [];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
