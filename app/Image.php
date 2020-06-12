<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function imageable()
    {
        return $this->morphTo();
    }

    public static function storeImages($images = [])
    {
        return array_map(
            function ($imageFile) {
                return $imageFile->store('uploads', 'public');
            },
            $images
        );
    }
}
