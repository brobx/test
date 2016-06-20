<?php

namespace App;

use App\Helpers\ImageHelper;
use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use Translatable, Loggable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'caption',
        'title'
    ];

    /**
     * 
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($photo) {
           ImageHelper::delete($photo->name);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function photoable()
    {
        return $this->morphTo();
    }
}
