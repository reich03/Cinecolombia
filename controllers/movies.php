<?php

class Movies extends Controller
{
    function __construct()
    {
        parent::__construct();
        error_log('movies-constructor::construct->Inicializa');
        $this->view->message = "Movies Controller";
    }

    function render()
    {   
        error_log('movies-controller::construct->Controlador de render');
        require_once '../Cine-Colombia/assets/DataPrueba/Movies.php';
        $this->view->movies = $movies;  
        $this->view->render('movies/index');
    }

    function view($params)
    {
        error_log('movies-view::construct->Movie vista');
        $movieId = $params[0];
        require_once '../Cine-Colombia/assets/DataPrueba/Movies.php';

        foreach ($movies as $movie) {
            if ($movie['id'] == $movieId) {
                $this->view->movie = $movie;
                break;
            }
        }

        $this->view->render('movies/view');
    }
}
