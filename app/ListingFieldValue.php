<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingFieldValue extends Model
{
    protected $table = 'listing_listing_field';

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listingField()
    {
        return $this->belongsTo(ListingField::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
