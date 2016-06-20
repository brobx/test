<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\Contracts\IPresentable;
use App\Presenters\TransactionPresenter;
use App\Presenters\Traits\PresentableTrait;

use Carbon\Carbon;

class Transaction extends Model implements IPresentable
{
    use PresentableTrait;

    /**
     * Presenter Class.
     *
     * @var [type]
     */
    protected $presenter = TransactionPresenter::class;

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'method',
        'listing_id',
        'user_id',
        'status',
        'fort_id'
    ];

    public static function boot()
    {
        self::created(function ($transaction) {
            $transaction->listing->buy(request());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns only the succeeded.
     * @param  $query
     * @return mixed
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 2);
    }

    /**
     * Returns the incomplete.
     * @param  $query
     * @return mixed
     */
    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeThisMonth($query)
    {
        return $query->whereBetween('transactions.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
