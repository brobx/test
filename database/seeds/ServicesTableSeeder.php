<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    protected $translatedNames = [
        'Credit Card' => 'بطاقة ائتمان',
        'Personal Loans' => 'قرض شخصي',
        'Car Loans' => 'قرض سيارة',
        'Home Loans' => 'تمويل عقاري',
        'Account' => 'حساب بنكى',
        'Deposit' => 'وديعة ادخارية',
        'SME Finance' => 'تمويل الشركات',
        'SME Accounts' => 'حسابات الشركات',
        'SME Cards' => 'بطاقات الشركات',
        'Voice Plans' => 'انظمة مكالمات',
        'Data Plans' => 'موبايل انترنت',
        'ADSL' => 'انترنت ارضى',
        'Domestic Travel' => 'رحلات داخلية',
        'International Travel' => 'رحلات دولية',
        'Hajj and Umrah' => 'حج وعمرة',
        'Honeymoon' => 'شهر عسل',
        'Adventures' => 'مغامرات'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Credit Card',
            'icon' => 'CreditCard',
            'service_type_id' => 1,
            'corporate_type_id' => 1
        ]);

        Service::create([
            'name' => 'Personal Loans',
            'icon' => 'PersonalLoan',
            'service_type_id' => 1,
            'corporate_type_id' => 1
        ]);

        Service::create([
            'name' => 'Car Loans',
            'icon' => 'CarLoan',
            'service_type_id' => 1,
            'corporate_type_id' => 1
        ]);

        Service::create([
            'name' => 'Home Loans',
            'icon' => 'HomeLoan',
            'service_type_id' => 1,
            'corporate_type_id' => 1
        ]);

        Service::create([
            'name' => 'Account',
            'icon' => 'Accounts',
            'service_type_id' => 1,
            'corporate_type_id' => 1
        ]);

        Service::create([
            'name' => 'Deposit',
            'icon' => 'Deposits',
            'service_type_id' => 1,
            'corporate_type_id' => 1
        ]);

        Service::create([
            'name' => 'SME Finance',
            'icon' => 'SMEFinance',
            'service_type_id' => 2,
            'corporate_type_id' => 1
        ]);

        Service::create([
            'name' => 'SME Accounts',
            'icon' => 'SMEAccounts',
            'service_type_id' => 2,
            'corporate_type_id' => 1
        ]);

        Service::create([
            'name' => 'SME Cards',
            'icon' => 'SMECards',
            'service_type_id' => 2,
            'corporate_type_id' => 1
        ]);

        Service::create([
            'name' => 'Voice Plans',
            'icon' => 'Voice',
            'corporate_type_id' => 2
        ]);

        Service::create([
            'name' => 'Data Plans',
            'icon' => 'Data',
            'corporate_type_id' => 2
        ]);

        Service::create([
            'name' => 'ADSL',
            'icon' => 'Mobile',
            'corporate_type_id' => 2
        ]);

        Service::create([
            'name' => 'Domestic Travel',
            'icon' => 'Domestic',
            'corporate_type_id' => 3
        ]);

        Service::create([
            'name' => 'International Travel',
            'icon' => 'travel',
            'corporate_type_id' => 3
        ]);

        Service::create([
            'name' => 'Honeymoon',
            'icon' => 'Honeymoon',
            'corporate_type_id' => 3
        ]);

        Service::create([
            'name' => 'Hajj and Umrah',
            'icon' => 'Hajj_Umrah',
            'corporate_type_id' => 3
        ]);


        // TODO: Add Adventure Icon.
        Service::create([
            'name' => 'Adventures',
            'icon' => 'Adventure',
            'corporate_type_id' => 3
        ]);

        $services = \App\Service::get();

        foreach ($services as $service) {
            $service->addTranslation([
                'translatable_attribute' => 'name',
                'translation' => $this->translatedNames[$service->name]
            ]);
        }
    }
}
