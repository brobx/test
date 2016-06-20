<?php

namespace App;

use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use Translatable;
    
    /**
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporateType()
    {
        return $this->belongsTo(CorporateType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
