<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Genre;
use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Film
 * @package App\Models
 * @version November 30, 2017, 12:06 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Comment
 * @property \Illuminate\Database\Eloquent\Collection filmsGenres
 * @property string name
 * @property string slug
 * @property string description
 * @property date release_date
 * @property smallInteger rating
 * @property decimal ticket_price
 * @property string country
 * @property string photo_url
 */
class Film extends Model
{
    use Sluggable;

    public $table = 'films';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'name',
        'slug',
        'description',
        'release_date',
        'rating',
        'ticket_price',
        'country',
        'photo_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'release_date' => 'date',
        'country' => 'string',
        'photo_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'films_genres');
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
