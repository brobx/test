<?php

namespace App;

use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use Translatable, Loggable;

    /**
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'url',
        'target_impressions',
        'corporate_id',
        'price'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spots()
    {
        return $this->belongsToMany(AdvertisementSpot::class)->withPivot('service_id');
    }

    /**
     * @param $spots
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function advertise($spots)
    {
        $this->spots()->detach();

        if(! is_array($spots) && ! count($spots)) {
            return;
        }

        foreach ($spots as $id => $attributes) {
            if(! is_array($attributes)) {
                $this->spots()->attach($id);

                continue;
            }

            $this->advertiseOn($id, $attributes);
        }
    }

    /**
     * Checks if an add is advertised on a specified spot, with an optional specific service.
     *
     * @param $spotId
     * @param null $serviceId
     */
    public function advertisedOn($spotId, $serviceId = null)
    {
        $query = $this->spots()->wherePivot('advertisement_spot_id', $spotId);

        if($serviceId) {
            $query->wherePivot('service_id', $serviceId);
        }

        return $query->exists();
    }

    /**
     * Advertises the ad on the given spot id with given attributes.
     *
     * @param $attributes
     * @param $spotId
     */
    protected function advertiseOn($spotId, $attributes)
    {
        foreach ($attributes as $serviceId => $on) {
            $this->spots()->attach($spotId, ['service_id' => $serviceId]);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporate()
    {
        return $this->belongsTo(Corporate::class);
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->impressions < $this->target_impressions;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->whereRaw('impressions < target_impressions');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeInactive($query)
    {
        return $query->whereRaw('impressions >= target_impressions');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function out($id)
    {
        $ad = $this->findOrFail($id);
        $ad->clicks = $ad->clicks + 1;
        $ad->save();

        return redirect($ad->url);
    }
}
