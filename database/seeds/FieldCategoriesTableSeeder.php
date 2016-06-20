<?php

use App\ListingFieldCategory;
use Illuminate\Database\Seeder;

class FieldCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createBankingCategories();
        $this->createMobileCategories();
        $this->createTravelCategories();
    }

    /**
     * Banking Categories.
     */
    private function createBankingCategories()
    {
        $categories = [
            'Highlights',
            'Parameters',
            'Personal',
            'Income',
            'Fees'
        ];

        $this->seedCategories(1, 4, $categories);


        // Accounts && Deposits.
        unset($categories[3]);
        $this->seedCategories(5, 6, $categories);

        // Business Banking.

        unset($categories[2]);
        $this->seedCategories(7, 9, $categories);
    }

    /**
     * Mobile Categories.
     */
    private function createMobileCategories()
    {
        $categories = [
            'Highlights',
            'Fees',
            'Bundled'
        ];

        $this->seedCategories(10, 12, $categories);
    }

    /**
     * Travel Categories.
     */
    private function createTravelCategories()
    {
        $categories = [
            'Highlights',
            'Destinations',
            'Nights',
            'Hotel',
            'Airline',
            'Itinerary',
            'Prices'
        ];

        $this->seedCategories(13, 16, $categories);
    }

    private function seedCategories($start, $end, $categories)
    {
        for ($i = $start; $i <= $end; $i++) {
            foreach ($categories as $category) {
                ListingFieldCategory::create(['title' => $category, 'service_id' => $i]);
            }
        }
    }
}
