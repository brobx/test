<?php

use App\Helpers\AdHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * @var array
     */
    private $truncateList = [
        'advertisements',
        'advertisement_spots',
        'advertisement_advertisement_spot',
        'users',
        'corporates',
        'corporate_types',
        'corporate_roles',
        'corporate_branches',
        'corporate_sliders',
        'corporate_details',
        'destinations',
        'leads',
        'f_a_qs',
        'f_a_q_categories',
        'service_types',
        'translations',
        'roles',
        'listing_fields',
        'listing_listing_field',
        'listing_field_categories',
        'listing_field_options',
        'listings',
        'topics',
        'services',
        'service_types',
        'post_categories',
        'pending_datas',
        'photos'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $isLocal = app()->isLocal();

        // Truncate to make sure there are no duplicates
        if($isLocal) {
            $this->truncate();
        }

        // Initial (Production) Seeders.
        $this->seedProduction();

        // Local Seeders
        if($isLocal) {
            $this->seedLocal();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }

    /**
     * Truncates the tables in the truncate list.
     */
    private function truncate()
    {
        foreach($this->truncateList as $table) {
            DB::table($table)->truncate();
        }
    }

    /**
     * Runs the production seeders (initial records).
     */
    private function seedProduction()
    {
        $this->call(CorporateTypesTableSeeder::class);
        $this->call(CorporateRolesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ServiceTypesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(FieldCategoriesTableSeeder::class);
        $this->call(ListingFieldsTableSeeder::class);
        $this->call(PostCategoryTableSeeder::class);
        $this->call(DestinationsTableSeeder::class);

        AdHelper::initializeSpots();
    }

    /**
     * Runs the local seeders.
     */
    private function seedLocal()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CorporatesTableSeeder::class);
        $this->call(ListingsTableSeeder::class);
        $this->call(AttachServicesToTravelSeeder::class);
    }
}
