<?php

namespace App;

use App\Filters\Admin\InvoiceFilter;
use App\Presenters\Contracts\IPresentable;
use App\Presenters\InvoicePresenter;
use App\Presenters\Traits\PresentableTrait;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model implements IPresentable
{
    use PresentableTrait;

    /**
     * @var
     */
    protected $presenter = InvoicePresenter::class;

    /**
     * @var array
     */
    protected $fillable = [
        'amount',
        'message',
        'paid',
        'discount'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function billable()
    {
        return $this->morphTo();
    }

    /**
     * @return $this
     */
    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('commission');
    }

    /**
     * @param Service $service
     * @return mixed
     */
    public function getCommission(Service $service)
    {
        return $this->services->find($service->id)->pivot->commission;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUnpaid($query)
    {
        return $query->where('paid', false);
    }

    /**
     * @param $query
     * @param InvoiceFilter $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, InvoiceFilter $filter)
    {
        return $filter->apply($query);
    }
}
