<?php

namespace App;

use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    use Translatable, Loggable;
    
    /**
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * @var string
     */
    public $table = 'f_a_q_categories';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(FAQ::class, 'category_id');
    }
}
