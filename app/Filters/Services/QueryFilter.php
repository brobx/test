<?php

namespace App\Filters\Services;

use App\Filters\Services\Banking\Accounts;
use App\Filters\Services\Banking\CarLoan;
use App\Filters\Services\Banking\CreditCard;
use App\Filters\Services\Banking\Deposits;
use App\Filters\Services\Banking\HomeLoan;
use App\Filters\Services\Banking\PersonalLoan;
use App\Filters\Services\Banking\SmeAccounts;
use App\Filters\Services\Banking\SmeCards;
use App\Filters\Services\Banking\SmeFinance;
use App\Filters\Services\Broadband\Adsl;
use App\Filters\Services\Broadband\DataPlan;
use App\Filters\Services\Broadband\VoicePlan;
use App\Filters\Services\Contracts\QueryFilter as QueryFilterContract;
use App\Filters\Services\Travel\Adventures;
use App\Filters\Services\Travel\Domestic;
use App\Filters\Services\Travel\HajjUmrah;
use App\Filters\Services\Travel\Honeymoon;
use App\Filters\Services\Travel\International;
use App\ListingFieldValue;
use App\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter implements QueryFilterContract
{
    /**
     * @var array
     */
    private static $serviceQueries = [
        1 => CreditCard::class,
        2 => PersonalLoan::class,
        3 => CarLoan::class,
        4 => HomeLoan::class,
        5 => Accounts::class,
        6 => Deposits::class,
        7 => SmeFinance::class,
        8 => SmeAccounts::class,
        9 => SmeCards::class,
        10 => VoicePlan::class,
        11 => DataPlan::class,
        12 => Adsl::class,
        13 => Domestic::class,
        14 => International::class,
        15 => Honeymoon::class,
        16 => HajjUmrah::class,
        17 => Adventures::class
    ];

    /**
     * @var array
     */
    protected $requestMap = [];

    /**
     * @var int
     */
    protected $serviceId;

    /**
     * @var Service
     */
    protected $service;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var
     */
    protected $query;

    /**
     * QueryObject constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->service = $request->route('services') ?: Service::findOrFail($this->serviceId);
        $this->query = $this->service->listings()->with('fields.translations', 'fields.photos', 'corporate.details');
    }

    /**
     * @return mixed
     */
    public abstract function getQuickSearchFields();

    /**
     * @return mixed
     */
    public abstract function getAdvancedSearchFields();

    /**
     * @return mixed
     */
    public abstract function getSortableFields();

    /**
     * @return mixed
     */
    public abstract function getComparisonFields();

    /**
     * Creates a query filter object.
     *
     * @param $serviceId
     * @return QueryFilter
     */
    public static function makeQueryObject($serviceId = null)
    {
        $requestServices = request()->route('services');
        if (!$serviceId && $requestServices) {
            $serviceId = $requestServices->id;
        }

        if (!isset(static::$serviceQueries[$serviceId])) {
            return null;
        }

        return app(static::$serviceQueries[$serviceId]);
    }

    /**
     * Applies the filters.
     *
     * @param Builder $builder
     * @return mixed
     */
    public function apply(Builder $builder = null)
    {
        $this->query = !$builder ?: $builder;
        $this->query->unsuspended();

        return $this->sort()->filter();
    }

    /**
     * Filters the request.
     *
     * @return mixed
     */
    public function filter()
    {
        foreach ($this->requestMap as $name => $id) {
            $this->filterField($name, $id);
        }

        return $this->query;
    }

    /**
     * Filters a field.
     *
     * @param $fieldName
     * @param $requestName
     */
    protected function filterField($requestName, $fieldName)
    {
        $methodName = camel_case('query_' . $fieldName);

        if (! method_exists($this, $methodName)) {
            return;
        }

        $value = $this->request->get($requestName);

        if (! $value) {
            return;
        }

        $this->{$methodName}($value);
    }

    /**
     * Sets the query scope to listings with values exactly like the queried.
     * @param $name
     * @param $value
     * @return
     */
    protected function queryExact($name, $value)
    {
        $this->query->whereHas('fields', function ($q) use ($value, $name) {
            $q->where('name', $name)->where("listing_listing_field.value", $value);
        });
    }

    /**
     * @return $this
     */
    protected function sort()
    {
        if ($this->request->has('order_by')) {
            $this->orderBy($this->request->get('order_by'));
        }

        return $this;
    }

    /**
     * @param $name
     */
    protected function orderBy($name)
    {
        $methodName = 'orderBy' . camel_case(ucfirst($name));

        if (method_exists($this, $methodName)) {
            $this->{$methodName}($this->request->get('order', 'ASC'));
        }
    }

    /**
     * @param $fields
     * @param $name
     * @return mixed
     */
    protected function extractFieldNameFromList($fields, $name)
    {
        return $fields->where('name', $name)->first()->translate()->name;
    }

    /**
     * Helps ordering listings by a specified numeric field.
     *
     * @param $fieldName
     * @param $order
     */
    protected function orderByNumericField($fieldName, $order)
    {
        // Get list of ordered ids, paginate them because you don't want too many results.
        $orderedIds = ListingFieldValue::with('listing')->whereHas('listingField', function ($q) use ($fieldName) {
            $q->where('name', $fieldName);
        })->orderByRaw("value * 1 $order")->get()->lists('listing.id')->toArray();

        $orderedIds = implode(',', $orderedIds);

        // Get Listings by that order.
        $this->query->orderByRaw("FIELD(id, $orderedIds)");
    }

    /**
     * @param $fieldName
     * @param $order
     */
    protected function orderByString($fieldName, $order)
    {
        // Get list of ordered ids, paginate them because you don't want too many results.
        $orderedIds = ListingFieldValue::with('listing')->whereHas('listingField', function ($q) use ($fieldName) {
            $q->where('name', $fieldName);
        })->orderBy("value", $order)->get()->lists('listing.id')->toArray();

        $orderedIds = implode(',', $orderedIds);

        // Get Listings by that order.
        $this->query->orderByRaw("FIELD(id, $orderedIds)");
    }

    /**
     * @return array
     */
    public function getRatingParameters()
    {
        return [];
    }

    /**
     * @param $fieldName
     * @param $order
     */
    protected function orderByDate($fieldName, $order)
    {
        // Get list of ordered ids, paginate them because you don't want too many results.
        $orderedIds = ListingFieldValue::with('listing')->whereHas('listingField', function ($q) use ($fieldName) {
            $q->where('name', $fieldName);
        })->orderByRaw("str_to_date(value,'%d-%m-%Y') $order")->get()->lists('listing.id')->toArray();

        $orderedIds = implode(',', $orderedIds);

        // Get Listings by that order.
        $this->query->orderByRaw("FIELD(id, $orderedIds)");
    }

    /**
     * Orders by rating.
     *
     * @param $order
     */
    protected function orderByRating($order)
    {
        $this->query->leftJoin('reviews', 'reviews.listing_id', '=', 'listings.id')
                    ->select('listings.*', 'reviews.rating')
                    ->orderBy('reviews.rating', $order);
    }

    /**
     * Queries the value between two fields.
     * @param $value
     * @param $firstField
     * @param $secondField
     */
    protected function numberBetween($value, $firstField, $secondField = null)
    {
        if(! $secondField) {
            $baseName = $firstField;
            $firstField = $baseName . ' Min.';
            $secondField = $baseName . ' Max.';
        }

        $this->query->whereHas('fields', function ($q) use ($value, $firstField) {
            $q->where('name', $firstField)->whereRaw("listing_listing_field.value * 1 <= {$value}");
        })->whereHas('fields', function ($q) use ($value, $secondField) {
            $q->where('name', $secondField)->whereRaw("listing_listing_field.value * 1 >= {$value}");
        });
    }

    /**
     * Queries the listings with a value less than the specified value.
     * @param $value
     * @param $fieldName
    */
    protected function numberBiggerThan($value, $fieldName)
    {
        $this->query->whereHas('fields', function ($q) use ($value, $fieldName) {
            $q->where('name', $fieldName)->whereRaw("listing_listing_field.value * 1 <= {$value}");
        });
    }
}
