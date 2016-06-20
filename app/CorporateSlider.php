<?php

namespace App;

use App\Traits\RequiresManagerApproval;
use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class CorporateSlider extends Model
{
    use Translatable, RequiresManagerApproval, Loggable;

    /**
     * @var array
     */
    protected $fillable = [
        'image', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporate()
    {
        return $this->belongsTo(Corporate::class);
    }
}
