<?php

use App\Destination;
use Illuminate\Database\Seeder;

class DestinationsTableSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $domesticCities = [
        'Sharm El Sheikh' => 'شرم الشيخ',
        'Hurghada' => 'الغردقة',
        'Ein El Sokhna' => 'العين السخنة',
        'Alexandria' => 'الاسكندرية',
        'Ras Sedr' => 'رأس سدر',
        'Western Desert' => 'الصحراء الغربية',
        'Luxor' => 'الاقصر',
        'Aswan' => 'اسوان',
        'Cairo' => 'القاهرة',
        'Saint Catherine' => 'سانت كاترين',
        'Matrouh' => 'مطروح',
        'El Gouna' => 'الجونة',
        'Taba' => 'طابا',
        'Marsa Alam' => 'مرسى علم',
        'Sahl Hasheesh' => 'سهل حشيش',
        'Dahab' => 'دهب'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Egyptian Cities.
        foreach ($this->domesticCities as $en => $ar) {
            Destination::create(['name' => $en, 'is_domestic' => true])
                       ->createTranslation('name', $ar);
        }

        // Seed International Cities
    }
}
