<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'ip',
        'type',
        'user_id',
        'message'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function loggable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
