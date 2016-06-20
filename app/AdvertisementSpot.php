<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementSpot extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'page',
        'service_bound'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class)->withPivot('service_id');
    }
}
