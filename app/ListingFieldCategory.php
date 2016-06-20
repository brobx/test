<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingFieldCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listingFields()
    {
        return $this->hasMany(ListingField::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
