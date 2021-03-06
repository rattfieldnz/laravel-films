<?php

namespace App\Models;

use App\Models\Film;
use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * @package App\Models
 * @version November 30, 2017, 12:09 pm UTC
 *
 * @property \App\Models\Film film
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection filmsGenres
 * @property string name
 * @property string comment
 * @property integer film_id
 * @property integer user_id
 */
class Comment extends Model
{
    public $table = 'comments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'name',
        'comment',
        'film_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'comment' => 'string',
        'film_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'min:1|max:30|required|string',
        'comment' => 'min:100|max:65535|required|string',
        'film_id' => 'integer|required|exists:films,id',
        'user_id' => 'integer|required|exists:users,id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
