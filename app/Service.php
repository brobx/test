<?php

namespace App;

use App\Filters\Services\QueryFilter;
use App\Traits\OwnsPhotos;
use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Translatable, OwnsPhotos;
    
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'icon'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function interestedUsers()
    {
        return $this->belongsToMany(User::class, 'interests');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporateType()
    {
        return $this->belongsTo(CorporateType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listingFields()
    {
        return $this->hasMany(ListingField::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listingCategories()
    {
        return $this->hasMany(ListingFieldCategory::class);
    }

    /**
     * @return mixed
     */
    public function getSortableFields()
    {
        return QueryFilter::makeQueryObject($this->id)->getSortableFields();
    }

    /**
     * @return mixed
     */
    public function getComparisonFields()
    {
        if(! $this->comparisonFields) {
            $this->comparisonFields = QueryFilter::makeQueryObject($this->id)->getComparisonFields();
        }
        
        return $this->comparisonFields;
    }
}
