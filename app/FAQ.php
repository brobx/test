<?php

namespace App;

use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use Translatable, Loggable;
    
    /**
     * @var array
     */
    protected $fillable = [
        'question',
        'answer',
        'category_id'
    ];

    /**
     * @var string
     */
    public $table = 'f_a_qs';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(FAQCategory::class, 'category_id');
    }
}
