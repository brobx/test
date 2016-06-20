<?php


namespace App\Helpers;

use App\Destination;
use App\ListingField;
use Faker\Factory;
use Faker\Generator;

class FieldFormatHelper
{
    /**
     * @param $field
     * @return mixed
     */
    public static function getRandomValue(ListingField $field)
    {
        $faker = Factory::create();

        switch ($field->type) {
            case 'checkbox': return static::getRandomOptionValue($field);
            case 'radio': return static::getRandomOptionValue($field);
            case 'commentsbox': return $faker->paragraph;
            case 'dropmenu': return static::getRandomOptionValue($field);
            case 'rangeslider': return static::getRandomRangeValue($field);
            case 'selectionslider': return static::getRandomOptionValue($field);
            case 'date': return static::getRandomDateValue($field, $faker);
            case 'numeric': return $faker->numberBetween(1, 99);
            case 'starselector': return $faker->numberBetween(1, 5);
            case 'egyptiancities': return static::getRandomDomesticCity($field);

            case 'textbox':
            default: return static::getRandomTextFieldValue($field, $faker);
        }
    }

    /**
     * @param $field
     * @return string
     */
    protected static function getRandomOptionValue(ListingField $field)
    {
        $options = $field->options->lists('name', 'id')->toArray();

        if(! $options) {
            return '';
        }

        return array_rand($options);
    }

    /**
     * @param $field
     * @return mixed
     */
    protected static function getRandomRangeValue(ListingField $field)
    {
        $settings = $field->settings;
        $min = $settings['min'];
        $max = $settings['max'];
        $values = [];

        for ($i = $min; $i < $max; $i += $settings['step']) {
            $values[] = $i;
        }

        return $values[array_rand($values)];
    }

    /**
     * @param ListingField $field
     * @param Generator $faker
     * @return string
     */
    protected static function getRandomTextFieldValue(ListingField $field, Generator $faker)
    {
        $format = $field->settings['format'];

        if(str_contains($format, 'percentage')) {
            return $faker->numberBetween(1, 100);
        }

        if(str_contains($format, 'number')) {
            return $faker->numberBetween(100, 10000);
        }
        
        return $faker->company;
    }

    /**
     * @param $field
     * @param Generator $faker
     * @return string
     */
    protected static function getRandomDateValue($field, Generator $faker)
    {
        if($field->name === 'Departure Date') {
            return $faker->date('d-m-Y', '-3 days');
        }

        return $faker->dateTimeBetween('now', '+3 days')->format('d-m-Y');
    }

    /**
     * @param $field
     */
    private static function getRandomDomesticCity($field)
    {
        $cities = Destination::domestic()->lists('name', 'id')->toArray();
        
        return array_rand($cities);
    }
}