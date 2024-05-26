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
        require_once '../Cine-Colombia/assets/DataPrueba/funciones.php';

        foreach ($movies as $movie) {
            if ($movie['id'] == $movieId) {
                $this->view->movie = $movie;
                break;
            }
        }

        $this->view->funciones = array_filter($funciones, function ($funcion) use ($movieId) {
            return $funcion['idpeliculas'] == $movieId;
        });

        $this->view->render('movies/view');
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
