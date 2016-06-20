<?php

namespace App;

use App\Translations\Translatable;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use Translatable;
    
    /**
     * @var array
     */
    protected $fillable = ['name', 'is_domestic'];

    /**
     * Sets the query scope to the domestic countries.
     *
     * @param $query
     * @return mixed
     */
    public function scopeDomestic($query)
    {
        return $query->where('is_domestic', true);
    }
}
