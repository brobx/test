<?php

namespace App;

use App\Traits\OwnsPhotos;
use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class CorporateType extends Model
{
    use Translatable, OwnsPhotos;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviceTypes()
    {
        return $this->hasMany(ServiceType::class);
    }

    /**
     * @return mixed
     */
    public function partners()
    {
        return $this->hasMany(Corporate::class, 'type_id')->withLogo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
