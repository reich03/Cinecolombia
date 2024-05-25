<?php

class Movies extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->message = "Movies Controller";
    }

    function render()
    {
        $this->view->render('movies/index');
    }

    function view($params)
    {
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
