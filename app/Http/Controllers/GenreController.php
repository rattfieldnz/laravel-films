<?php

namespace App\Http\Controllers;

use App\Repositories\GenreRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Response;

class GenreController extends AppBaseController
{
    /** @var  GenreRepository */
    private $genreRepository;

    public function __construct(GenreRepository $genreRepo)
    {
        $this->genreRepository = $genreRepo;
    }

    /**
     * Display a listing of the Genre.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $this->genreRepository->pushCriteria(new RequestCriteria($request));
            $genres = $this->genreRepository->all();

            return view('genres.index')
                ->with('genres', $genres);
        } catch (RepositoryException $e) {
            abort(500, $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new Genre.
     *
     * @return Response
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Display the specified Genre.
     *
     * @param $slug
     *
     * @return Response
     */
    public function show($slug)
    {
        $genre = $this->genreRepository->findByField('slug', $slug);

        if (empty($genre)) {
            Flash::error('Genre not found');

            return redirect(route('genres.index'));
        }

        return view('genres.show')->with('genre', $genre);
    }

    /**
     * Show the form for editing the specified Genre.
     *
     * @param $slug
     *
     * @return Response
     */
    public function edit($slug)
    {
        $genre = $this->genreRepository->findByField('slug', $slug);

        if (empty($genre)) {
            Flash::error('Genre not found');

            return redirect(route('genres.index'));
        }

        return view('genres.edit')->with('genre', $genre);
    }
}
