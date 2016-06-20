<?php

namespace App;

use App\Traits\RequiresManagerApproval;
use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class CorporateBranch extends Model
{
    use Translatable, RequiresManagerApproval, Loggable;

    /**
     * @var array
     */
    protected $fillable = [
        'address', 'name', 'longitude', 'latitude',
        'working_hours', 'phone'
    ];

    /**
     * @return string
     */
    public function logName()
    {
        return 'branch';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporate()
    {
        return $this->belongsTo(Corporate::class);
    }
}
