<?php

namespace App\Repositories;

use App\Models\Genre;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GenreRepository
 * @package App\Repositories
 * @version November 30, 2017, 12:11 pm UTC
 *
 * @method Genre findWithoutFail($id, $columns = ['*'])
 * @method Genre find($id, $columns = ['*'])
 * @method Genre first($columns = ['*'])
*/
class GenreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Genre::class;
    }
}
