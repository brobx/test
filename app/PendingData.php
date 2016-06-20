<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User;

class PendingData extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'attributes', 'corporate_id', 'type', 'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporate()
    {
        return $this->belongsTo(Corporate::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function pendingModel()
    {
        return $this->morphTo('pending');
    }

    public function apply()
    {
        switch ($this->type) {
            case 'create': $this->applyCreate(); break;
            case 'update': $this->applyUpdate(); break;
            case 'delete': $this->applyDelete(); break;
        }

        $this->delete();
    }

    /**
     * @return Listing
     */
    protected function applyCreateListing()
    {
        $attributes = json_decode($this->attributes['attributes'], true);
        $listing = new Listing($attributes['data']);
        $listing->corporate_id = auth()->user()->corporate_id;
        $listing->service_id = $attributes['service_id'];
        $listing->save();

        if(isset($attributes['translations'])) {
            foreach ($attributes['translations'] as $translation) {
                $listing->addTranslation($translation);
            }
        }

        if(isset($attributes['photos'])) {
            $listing->addPhotos($attributes['photos']);
        }

        $listing->fields()->attach($attributes['fields']);

        return $listing;
    }


    /**
     * @return Listing
     */
    protected function applyUpdateListing()
    {
        $attributes = json_decode($this->attributes['attributes'], true);
        $listing = $this->pendingModel;
        $listing->update($attributes['data']);

        if(isset($attributes['translations'])) {
            foreach ($attributes['translations'] as $translation) {
                $listing->updateTranslation($translation['translatable_attribute'], $translation['translation']);
            }
        }

        if(isset($attributes['photos'])) {
            $listing->addPhotos($attributes['photos']);
        }

        return $listing->fields()->sync($attributes['fields']);
    }

    /**
     * @return mixed
     */
    protected function applyCreate()
    {
        if($this->pending_type === Listing::class) {
            return $this->applyCreateListing();
        }
        
        $attributes = json_decode($this->attributes['attributes'], true);
        $modelInstance = new $this->pending_type;
        $fillableAttributes = array_only($attributes, $modelInstance->getFillable());
        $createdModel = new $this->pending_type($fillableAttributes);
        $createdModel->corporate_id = auth()->user()->corporate_id;
        $createdModel->save();

        if(isset($attributes['translations'])) {
            foreach ($attributes['translations'] as $translation) {
                $createdModel->addTranslation($translation);
            }
        }

        return $createdModel;
    }

    /**
     * @return mixed
     */
    protected function applyUpdate()
    {
        if($this->pending_type === Listing::class) {
            return $this->applyUpdateListing();
        }

        $attributes = json_decode($this->attributes['attributes'], true);
        $modelInstance = $this->pendingModel;
        $fillableAttributes = array_only($attributes, $modelInstance->getFillable());

        if(isset($attributes['translations'])) {
            foreach ($attributes['translations'] as $translation) {
                $modelInstance->updateTranslation($translation['translatable_attribute'], $translation['translation']);
            }
        }

        return $modelInstance->update($fillableAttributes);
    }

    /**
     * @return mixed
     */
    protected function applyDelete()
    {
        return $this->pendingModel->delete();
    }
}
