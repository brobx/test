<?php

namespace App;

use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use Translatable, Loggable;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'priority'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
