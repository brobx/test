<?php

namespace App;

use App\Presenters\Contracts\IPresentable;
use App\Presenters\FieldPresenter;
use App\Presenters\Traits\PresentableTrait;
use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class ListingField extends Model implements IPresentable
{
    use Translatable, PresentableTrait;

    /**
     * @var
     */
    protected $presenter = FieldPresenter::class;
    
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'unit',
        'settings'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'settings' => 'json'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ListingFieldCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'listing_listing_field')->withPivot('value');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(ListingFieldOption::class);
    }

    /**
     * Scopes the fields to the ones which belong to the highlights category.
     * 
     * @param $query
     * @return mixed
     */
    public function scopeHighlights($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('title', 'Highlights');
        });
    }

    /**
     * @return string
     */
    public function getValueAttribute()
    {
        if($this->type == 'egyptiancities') {
            $destination = Destination::domestic()->where('id', $this->pivot->value)->first();

            return $destination ? $destination->translate()->name : '---';
        }

        $optionsCount = $this->options()->count();

        if(! $optionsCount) {
            return $this->pivot->value;
        }

        $valueModel = $this->options()->where('id', $this->pivot->value)->first();

        return $valueModel ? $valueModel->translate()->name : '---';
    }
}
