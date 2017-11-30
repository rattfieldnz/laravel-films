<?php

namespace App\Http\Controllers;

use App\Repositories\FilmRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Response;

class FilmController extends AppBaseController
{
    /** @var  FilmRepository */
    private $filmRepository;

    public function __construct(FilmRepository $filmRepo)
    {
        $this->filmRepository = $filmRepo;
    }

    /**
     * Display a listing of the Film.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $this->filmRepository->pushCriteria(new RequestCriteria($request));
            $films = $this->filmRepository->paginate(1);

            return view('films.index')
                ->with('films', $films);
        } catch (RepositoryException $e) {
            abort(500, $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new Film.
     *
     * @return Response
     */
    public function create()
    {
        return view('films.create');
    }

    /**
     * Display the specified Film.
     *
     * @param $slug
     *
     * @return Response
     */
    public function show($slug)
    {
        $film = $this->filmRepository->findByField('slug', $slug);

        if (empty($film)) {
            Flash::error('Film not found');

            return redirect(route('films.index'));
        }

        return view('films.show')->with('film', $film);
    }

    /**
     * Show the form for editing the specified Film.
     *
     * @param $slug
     *
     * @return Response
     */
    public function edit($slug)
    {
        $film = $this->filmRepository->findByField('slug', $slug);

        if (empty($film)) {
            Flash::error('Film not found');

            return redirect(route('films.index'));
        }

        return view('films.edit')->with('film', $film);
    }
}
