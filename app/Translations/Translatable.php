<?php
/**
 * Created by PhpStorm.
 * User: logar
 * Date: 3/16/2016
 * Time: 07:07
 */

namespace App\Translations;

use App\Translation;
use Illuminate\Support\Collection;

trait Translatable
{
    /**
     * @var
     */
    protected $translationCollection = null;

    /**
     * Make sure to delete translations.
     */
    public static function bootTranslatable()
    {
        static::deleting(function ($model) {
            $model->translations()->delete();
        });
    }

    /**
     * @param string $languageId
     * @return TranslationCollection
     */
    public function translate($languageId = null)
    {
        if(! $languageId) {
            $languageId = config('app.locale');
        }

        if (! $this->translationCollection) {
            $translations = $this->translations->where('language_id', $languageId);
            $this->translationCollection = new TranslationCollection($this, $translations, $languageId);
        }

        return $this->translationCollection;
    }

    /**
     * Adds a new translation.
     *
     * @param $attributes
     */
    public function addTranslation($attributes)
    {
        // Makes sure if no language was specified, arabic will be used instead.
        if (! isset($attributes['language_id'])) {
            $attributes['language_id'] = 'ar';
        }

        return $this->translations()->create($attributes);
    }

    /**
     * @param $attributeName
     * @param $value
     * @param string $languageId
     */
    public function createTranslation($attributeName, $value, $languageId = 'ar')
    {
        return $this->translations()->create([
            'translatable_attribute' => $attributeName,
            'translation' => $value,
            'language_id' => $languageId
        ]);
    }

    /**
     * @param $attributeName
     * @param $value
     * @param string $languageId
     */
    public function updateTranslation($attributeName, $value, $languageId = 'ar')
    {
        return $this->translations()
                    ->updateOrCreate([
                        'translatable_attribute' => $attributeName,
                        'language_id' => $languageId
                    ], [
                        'translation' => $value,
                    ]);
    }

    /**
     * @param $attributeName
     * @param string $languageId
     * @return mixed
     */
    public function getTranslation($attributeName, $languageId = 'ar')
    {
        return $this->translations()
                    ->where(['translatable_attribute' => $attributeName, 'language_id' => $languageId])
                    ->first();
    }

    /**
     * @return mixed
     */
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }
}

class TranslationCollection
{
    /**
     * @var
     */
    protected $entity;

    /**
     * @var Collection
     */
    protected $translations;

    /**
     * @var
     */
    protected $languageId;

    /**
     * TranslationCollection constructor.
     * @param $entity
     * @param $translations
     * @param $languageId
     */
    public function __construct($entity, $translations, $languageId)
    {
        $this->entity = $entity;
        $this->translations = $translations;
        $this->languageId = $languageId;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $fallback = $this->entity->{$name};

        if($this->languageId == 'en') {
            return $fallback;
        }

        $match = $this->translations->where('translatable_attribute', $name)->first();
        
        if($match) {
            return $match->translation ?: $fallback;
        }

        return $fallback;
    }
}
