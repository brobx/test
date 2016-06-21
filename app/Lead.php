<?php

namespace App;

use App\Presenters\Contracts\IPresentable;
use App\Presenters\LeadPresenter;
use App\Presenters\Traits\PresentableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model implements IPresentable
{
    use PresentableTrait;

    /**
     * @var
     */
    protected $presenter = LeadPresenter::class;

    /**
     * @var array
     */
    protected $fillable = [
        'type', 
        'ip_address',
        'language',
        'user_id',
        'listing_id',
        'preffered_call_time'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePaid($query)
    {
        return $query->whereNotNull('payment_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUnpaid($query)
    {
        return $query->whereNull('payment_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeThisYear($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->firstOfYear());
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeThisMonth($query)
    {
        return $query->whereBetween('leads.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeThisWeek($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->startOfWeek());
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLastWeek($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->subWeek(1)->startOfWeek(),
            Carbon::now()->subWeek(1)->endOfWeek()
        ]);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLastYear($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->subYear(1)->firstOfYear(),
            Carbon::now()->subYear(1)->endOfYear()
        ]);
    }

    /**
     * @param $query
     * @param $count
     * @return mixed
     */
    public function scopeSpanYears($query, $count)
    {
        return $query->where('created_at', '>=', new Carbon("-$count years"));
    }

    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUnrated($query)
    {
        return $query->has('review', 0);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePending($query)
    {
        return $query->where('canceled', false);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeCanceled($query)
    {
        return $query->where('canceled', true);
    }
}
