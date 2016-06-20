<?php

use App\Corporate;
use App\Helpers\FieldFormatHelper;
use App\Listing;
use App\Service;
use Illuminate\Database\Seeder;

class ListingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Credit Cards.
        
        $corporates = Corporate::with('type.services.listingFields.options')->get();
        
        foreach ($corporates as $corporate) {
            $services = $corporate->type->services;
            
            foreach ($services as $service) {
                $this->createListings($corporate->id, $service->id);
            }
        }
    }

    /**
     * @param $corporateId
     * @param $serviceId
     */
    protected function createListings($corporateId, $serviceId)
    {
        $listings = factory(Listing::class, 30)->create([
            'corporate_id' => $corporateId,
            'service_id' => $serviceId
        ]);

        $this->seedFields($listings);
    }

    /**
     * @param $listing
     */
    protected function seedFields($listing)
    {
        if($listing instanceof Listing) {
            $this->fillListing($listing);
        }

        foreach ($listing as $singleListing) {
            $this->fillListing($singleListing);
        }
    }

    /**
     * @param Listing $listing
     */
    protected function fillListing(Listing $listing)
    {
        $service = $listing->service;
        $fields = [];
        
        foreach ($service->listingFields as $field) {
            $fields[$field->id] = ['value' => FieldFormatHelper::getRandomValue($field)];
        }

        $listing->fields()->attach($fields);
    }
}
