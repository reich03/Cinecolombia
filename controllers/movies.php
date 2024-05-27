<?php

class Movies extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->loadModel('movies');
        error_log('movies-constructor::construct->Inicializa');
        $this->view->message = "Movies Controller";
    }

    function render()
    {
        error_log('movies-controller::construct->Controlador de render');
        $movies = $this->model->getAllMovies();
        $this->view->movies = $movies;
        $this->view->render('movies/index');
    }

    function view($params)
    {
        error_log('movies-view::construct->Movie vista');
        $movieId = $params[0];
        $movie = $this->model->getMovieById($movieId);

        if ($movie) {
            $this->view->movie = $movie;
            $this->view->render('movies/view');
        } else {
            error_log('movies-view::construct->Movie no encontrada');
            $this->view->message = "Película no encontrada";
            $this->view->render('movies/error');
        }
    }

    function selectSeats($params)
    {
        $funcionId = $params[0];
        require_once '../Cine-Colombia/assets/DataPrueba/funciones.php';
        require_once '../Cine-Colombia/assets/DataPrueba/rooms.php';

        foreach ($funciones as $funcion) {
            if ($funcion['idfuncion'] == $funcionId) {
                $this->view->funcion = $funcion;
                break;
            }
        }

        foreach ($rooms as $room) {
            if ($room['id'] == $this->view->funcion['idsala']) {
                $this->view->room = $room;
                break;
            }
        }

        $this->view->render('movies/selectSeats');
    }
}
?>
