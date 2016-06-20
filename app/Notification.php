<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'body',
        'url',
        'icon',
        'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUnread($query)
    {
        return $query->where('unread', true);
    }
}
