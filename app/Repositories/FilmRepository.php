<?php

namespace App\Repositories;

use App\Models\Film;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FilmRepository
 * @package App\Repositories
 * @version November 30, 2017, 12:06 pm UTC
 *
 * @method Film findWithoutFail($id, $columns = ['*'])
 * @method Film find($id, $columns = ['*'])
 * @method Film first($columns = ['*'])
*/
class FilmRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return Film::class;
    }
}
