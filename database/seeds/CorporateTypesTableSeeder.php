<?php

use App\CorporateType;
use Illuminate\Database\Seeder;

class CorporateTypesTableSeeder extends Seeder
{
    protected $translatedNames = [
        'Banking' => 'بنوك',
        'Mobile and Broadband' => 'الشبكات والاتصالات',
        'Travel Agency' => 'السفر',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CorporateType::create(['title' => 'Banking', 'slug' => 'banking']);
        CorporateType::create(['title' => 'Mobile and Broadband', 'slug' => 'broadband']);
        CorporateType::create(['title' => 'Travel Agency', 'slug' => 'travel']);

        $corporatesTypes = \App\CorporateType::get();

        foreach ($corporatesTypes as $corporateType) {
            $corporateType->addTranslation([
                'translatable_attribute' => 'title',
                'translation' => $this->translatedNames[$corporateType->title]
            ]);
        }
    }
}
