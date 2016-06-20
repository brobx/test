<?php

namespace App;

use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class ListingFieldOption extends Model
{
    use Translatable;

    /**
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listingField()
    {
        return $this->belongsTo(ListingField::class);
    }
}
