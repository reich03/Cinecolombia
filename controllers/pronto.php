<?php

class Pronto extends Controller
{
    function __construct()
    {
        parent::__construct();
        error_log('pronto-constructor::construct->Inicializa');
        $this->view->message = "pronto Controller";
    }

    function render()
    {   
        error_log('pronto-controller::construct->Controlador de render');
        require_once '../Cine-Colombia/assets/DataPrueba/Movies.php';
        $this->view->movies = $movies;  
        $this->view->render('pronto/index');
    }

    function view($params)
    {
        error_log('movies-view::construct->pronto vista');
        $movieId = $params[0];
        require_once '../Cine-Colombia/assets/DataPrueba/Movies.php';

        foreach ($movies as $movie) {
            if ($movie['id'] == $movieId) {
                $this->view->movie = $movie;
                break;
            }
        }

        $this->view->render('pronto/view');
    }
}
