<?php


namespace App\Filters\Services\Travel;


use App\Filters\Services\QueryFilter;
use App\ListingField;

class Domestic extends QueryFilter
{
    /**
     * @var int
     */
    protected $serviceId = 13;

    /**
     * @var array
     */
    protected $requestMap = [
        'destination1' => 'destination',
        'departure_date' => 'departureDate',
        'return_date' => 'returnDate',
        'noof_guests' => 'travelersCount',
        'hotel1_stars' => 'hotelStars',
        'food&_beverage' => 'food',
        'price(_package)' => 'price',
        'seat_class' => 'seatClass'
    ];

    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', ['Departure Date', 'Return Date', 'No. of Guests', 'Destination 1'])
                                ->get();

        return $fields;
    }

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', [
                                    'Departure Date',
                                    'Return Date',
                                    'No. of Guests',
                                    'Hotel 1 Stars',
                                    'Destination 1',
                                    'Price (Package)',
                                    'Seat Class',
                                    'Food & Beverage'
                                   ])
                                ->get();

        return $fields;
    }

    /**
     * Queries Destination.
     *
     * @param $value
     */
    protected function queryDestination($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->whereIn('name', ['Destination 1', 'Destination 2', 'Destination 3'])
              ->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries Departure.
     *
     * @param $value
     */
    protected function queryDepartureDate($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Departure Date')
              ->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries Return Date.
     *
     * @param $value
     */
    protected function queryReturnDate($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Return Date')
              ->where('listing_listing_field.value', $value);
        });
    }

    /**
     * @param $value
     */
    protected function queryTravelersCount($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'No. of Guests')
              ->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries the hotel stars.
     *
     * @param $value
     * @return void
     */
    protected function queryHotelStars($value)
    {
        $this->queryExact("Hotel 1 Stars", $value);
    }

    /**
     * Queries the food inclusion.
     *
     * @param $value
     * @return void
     */
    protected function queryFood($value)
    {
        $this->queryExact("Food & Beverage", $value);
    }

    /**
     * Queries the seat class.
     *
     * @param $value
     * @return void
     */
    protected function querySeatClass($value)
    {
        $this->queryExact("Seat Class", $value);
    }

    /**
     * Queries the price package.
     *
     * @param $value
     * @return void
     */
    protected function queryPrice($value)
    {
        $this->numberBiggerThan($value, 'Price (Package)');
    }

    /**
     * @return mixed
     */
    public function getSortableFields()
    {
        $fields = $this->service->listingFields()->with('translations')->get();

        return [
            'price' => $this->extractFieldNameFromList($fields, 'Price (Package)'),
            'hotel_stars' => $this->extractFieldNameFromList($fields, 'Hotel 1 Stars'),
            'departure_date' => $this->extractFieldNameFromList($fields, 'Departure Date'),
        ];
    }

    /**
     * @param $order
     */
    protected function orderByPrice($order)
    {
        $this->orderByNumericField('Price (Package)', $order);
    }

    /**
     * @param $order
     */
    protected function orderByHotelStars($order)
    {
        $this->orderByNumericField('Hotel 1 Stars', $order);
    }

    /**
     * @param $order
     */
    protected function orderByDepartureDate($order)
    {
        $this->orderByDate('Departure Date', $order);
    }

    /**
     * @return mixed
     */
    public function getComparisonFields()
    {
        return $this->service->listingFields()
                             ->with('options')
                             ->whereIn('name', [
                                 'No. of Nights (Destination 1)',
                                 'No. of Nights (Destination 2)',
                                 'No. of Nights (Destination 3)',
                                 'Departure Date',
                                 'Return Date',
                                 'Hotel 1 Stars',
                                 'Hotel 2 Stars',
                                 'Hotel 3 Stars',
                                 'Airline',
                                 'Seat Class',
                                 'Price (Package)',
                                 'No. of Guests',
                                 'Food & Beverage'
                             ])->get();
    }
}
