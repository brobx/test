<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'lead_id',
        'listing_id',
        'rating',
        'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param int $listingId
     * @return array
     */
    public function getReviewByListingId($listingId)
    {
        return \DB::table('reviews')
            ->where('listing_id', '=', $listingId)
            ->select(\DB::raw('SUM(rating)/COUNT(listing_id) as sum_rating'), 'type')
            ->groupBy('type')
            ->get();
    }
}
