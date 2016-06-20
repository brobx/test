<?php

use Illuminate\Database\Seeder;

class ServiceTypesTableSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $translatedNames = [
        'Personal Banking' => 'أفراد',
        'Business Banking' => 'شركات',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = \App\ServiceType::create(['title' => 'Personal Banking', 'corporate_type_id' => 1]);
        $type->addTranslation([
            'translatable_attribute' => 'title',
            'translation' => $this->translatedNames[$type->title]
        ]);

        $type = \App\ServiceType::create(['title' => 'Business Banking', 'corporate_type_id' => 1]);
        $type->addTranslation([
            'translatable_attribute' => 'title',
            'translation' => $this->translatedNames[$type->title]
        ]);
    }
}
