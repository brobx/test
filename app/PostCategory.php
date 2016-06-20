<?php

namespace App;

use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
	use Translatable, Loggable;

    /**
     * @var array
     */
	protected $fillable = ['title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
