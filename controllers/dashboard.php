<?php 

class Dashboard extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->loadModel('dashboard');
        error_log('Dashboard::construct->Inicializa');
    }

    function render()
    {
        $this->view->render('dashboard/index');
    }

    function movies()
    {
        $movies = $this->model->getAllMovies(); 
        $this->view->movies = $movies;
        $this->view->render('dashboard/movies');
    }

    function rooms()
    {
        $this->view->render('dashboard/rooms');
    }

    function users()
    {
        $this->view->render('dashboard/users');
    }

    function statistics()
    {
        $this->view->render('dashboard/statistics');
    }

    function createMovie()
    {
        if ($this->model->insertMovie($_POST, $_FILES)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    function updateMovie()
    {
        if ($this->model->updateMovie($_POST, $_FILES)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    function deleteMovie($params)
    {
        $movieId = $params[0];
        if ($this->model->deleteMovie($movieId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    function getMovie($params)
    {
        $movieId = $params[0];
        $movie = $this->model->getMovieById($movieId);
        echo json_encode($movie);
    }
}
