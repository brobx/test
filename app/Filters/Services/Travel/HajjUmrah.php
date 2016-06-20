<?php

namespace App\Filters\Services\Travel;

use App\Filters\Services\QueryFilter;

class HajjUmrah extends QueryFilter
{
    /**
     * @var int
     */
    protected $serviceId = 16;

    /**
     * @var array
     */
    protected $requestMap = [
        'hajj_umrah' => 'type',
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
        return $this->service->listingFields()
                             ->with('options')
                             ->whereIn('name', ['Hajj / Umrah', 'Departure Date', 'Return Date', 'No. of Guests'])
                             ->get();
    }

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', [
                                    'Hajj / Umrah',
                                    'Departure Date',
                                    'Return Date',
                                    'Hotel 1 Stars',
                                    'No. of Guests',
                                    'Price (Package)',
                                    'Seat Class',
                                    'Food & Beverage'
                                   ])
                                ->get();

        return $fields;    }

    /**
     * Queries Haj and Umrah.
     *
     * @param $value
     */
    protected function queryType($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Hajj / Umrah')
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
     * Queries Departure.
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
                                 'Departure Date',
                                 'Return Date',
                                 'Hotel 1 Stars',
                                 'Hotel 2 Stars',
                                 'Airline',
                                 'Seat Class',
                                 'Price (Package)',
                                 'No. of Guests',
                                 'Food & Beverage'
                             ])->get();
    }
}
