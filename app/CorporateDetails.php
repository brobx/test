<?php

namespace App;

use App\Traits\RequiresManagerApproval;
use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class CorporateDetails extends Model
{
    use Translatable, RequiresManagerApproval;

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'phone',
        'website',
        'description',
        'logo',
        'call_center_email'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporate()
    {
        return $this->belongsTo(Corporate::class);
    }
}
