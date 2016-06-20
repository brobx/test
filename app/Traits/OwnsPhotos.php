<?php

namespace App\Traits;

use App\Photo;

trait OwnsPhotos
{
    /**
     * @return mixed
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    /**
     *
     */
    public static function bootOwnsPhotos()
    {
        static::deleting(function($model) {
            foreach ($model->photos as $photo) {
                $photo->delete();
            }
        });
    }

    /**
     * @param $photos
     * @return int|void
     */
    public function addPhotos($photos)
    {
        if(! $photos) {
            return 0;
        }

        $count = 0;

        foreach ($photos as $attributes) {
            $photo = $this->photos()->create([
                'name' => $attributes['image'],
                'caption' => $attributes['description'],
                'title' => isset($attributes['title']) ? $attributes['title'] : null
            ]);
            
            $photo->createTranslation('caption', $attributes['description_ar']);

            if(isset($attributes['title'])) {
                $photo->createTranslation('title', $attributes['title_ar']);
            }

            $count++;
        }
        
        return $count;
    }
}