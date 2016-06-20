<?php

namespace App;

use App\Traits\RequiresManagerApproval;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'translation', 'language_id', 'translatable_attribute'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function translatable()
    {
        return $this->morphTo();
    }
}
