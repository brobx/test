<?php

namespace App;

use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Translatable, Loggable;
    
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'image'
    ];

    /**
     * @param $value
     */
    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = $value;

        $this->attributes['corporate_type_id'] = $value > 1 ? $value - 1 : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporateType()
    {
        return $this->belongsTo(CorporateType::class);
    }
}
