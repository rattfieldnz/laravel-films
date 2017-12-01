<?php

namespace App\Models;

use App\Models\Film;
use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Genre
 * @package App\Models
 * @version November 30, 2017, 12:11 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection comments
 * @property \Illuminate\Database\Eloquent\Collection filmsGenres
 * @property string name
 */
class Genre extends Model
{
    use Sluggable;

    public $table = 'genres';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'name',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function films()
    {
        return $this->belongsToMany(Film::class, 'films_genres');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
