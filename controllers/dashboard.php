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
        $rooms = $this->model->getAllRooms();
        $this->view->rooms = $rooms;
        $this->view->render('dashboard/rooms');
    }


    function users()
    {
        $users = $this->model->getAllUsers();
        $this->view->users = $users;
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

    function getAllDirectors()
    {
        $directors = $this->model->getAllDirectors();
        echo json_encode($directors);
    }

    function getAllActors()
    {
        $actors = $this->model->getAllActors();
        echo json_encode($actors);
    }

    function createUser()
    {
        if ($this->model->insertUser($_POST)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    function getUser($params)
    {
        $userId = $params[0];
        $role = $params[1];
        $user = $this->model->getUserById($userId, $role);
        echo json_encode($user);
    }

    function updateUser()
    {
        if ($this->model->updateUser($_POST)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    function deleteUser($params)
    {
        $userId = $params[0];
        $role = $params[1];
        if ($this->model->deleteUser($userId, $role)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }



    function createRoom()
    {
        if ($this->model->insertRoom($_POST)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    function updateRoom()
    {
        if ($this->model->updateRoom($_POST)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    function deleteRoom($params)
    {
        $roomId = $params[0];
        if ($this->model->deleteRoom($roomId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    function getRoom($params)
    {
        $roomId = $params[0];
        $room = $this->model->getRoomById($roomId);
        echo json_encode($room);
    }

    function functiones()
    {
        $functions = $this->model->getAllFunctions();
        $movies = $this->model->getAllMovies();
        $rooms = $this->model->getAllRooms();
        $this->view->functions = $functions;
        $this->view->movies = $movies;
        $this->view->rooms = $rooms;
        $this->view->render('dashboard/functiones');
    }

    function createFunction()
    {
        if ($this->model->insertFunction($_POST)) {
            echo json_encode(['status' => 'success']);
        } else {
            $message = $this->model->isRoomAvailable($_POST['hora_inicio'], $_POST['hora_fin'], $_POST['fecha'], $_POST['idsala']) ? 'Error desconocido' : 'Sala no disponible en ese horario';
            echo json_encode(['status' => 'error', 'message' => $message]);
        }
    }

    function updateFunction()
    {
        if ($this->model->updateFunction($_POST)) {
            echo json_encode(['status' => 'success']);
        } else {
            $message = $this->model->isRoomAvailable($_POST['hora_inicio'], $_POST['hora_fin'], $_POST['fecha'], $_POST['idsala'], $_POST['idfuncion']) ? 'Error desconocido' : 'Sala no disponible en ese horario';
            echo json_encode(['status' => 'error', 'message' => $message]);
        }
    }



    function deleteFunction($params)
    {
        $functionId = $params[0];
        if ($this->model->deleteFunction($functionId)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    function getFunction($params)
    {
        $functionId = $params[0];
        $function = $this->model->getFunctionById($functionId);
        echo json_encode($function);
    }
    public function getOcupiedSeats($idFuncion) {
        $ocupiedSeats = $this->model->getOcupiedSeatsByFunction($idFuncion);
        echo json_encode($ocupiedSeats);
    }
    
    
}
