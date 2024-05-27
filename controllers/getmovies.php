<?php

class GetMovies extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->loadModel('movies'); 
    }

    function getAllMovies()
    {
        $movies = $this->model->getAllMovies();
        echo json_encode($movies);
    }
}
