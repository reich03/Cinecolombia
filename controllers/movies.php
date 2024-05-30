<?php

require_once 'core/email_helper.php'; 

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

    function createSale() {
        session_start();
    
        if (!isset($_SESSION['user'])) {
            echo json_encode(['error' => 'Debe iniciar sesión para realizar una compra.']);
            return;
        }
    
        $user = $_SESSION['user'];
        if (!isset($user['id'])) {
            echo json_encode(['error' => 'Información del cliente no encontrada.']);
            return;
        }
    
        $data = json_decode(file_get_contents('php://input'), true);
    
        $asientos = array_map(function($asiento) {
            return [
                'id' => $asiento['id'],
                'clase' => $asiento['clase']
            ];
        }, $data['asientos']);
    
        $ventaData = [
            'idfuncion' => $data['idfuncion'],
            'idcliente' => $user['id'],
            'idempleado' => 2,
            'precionentrada' => $data['precionentrada'],
            'asientos' => $asientos,
            'idsala' => $data['idsala']
        ];
    
        if ($this->model->createSale($ventaData)) {
            $resumenDetalles = "
                <h4>Resumen de Compra</h4>
                <p><strong>Usuario:</strong> {$user['nombre']} {$user['apellido']}</p>
                <p><strong>Correo:</strong> {$user['correo']}</p>
                <p><strong>Película:</strong> {$this->view->movie['titulo']}</p>
                <p><strong>Fecha:</strong> {$data['fecha']}</p>
                <p><strong>Hora:</strong> {$data['hora']}</p>
                <p><strong>Sala:</strong> {$data['sala']}</p>
                <p><strong>Asientos:</strong> " . implode(', ', array_column($asientos, 'id')) . "</p>
                <p><strong>Total:</strong> {$data['precionentrada']}</p>
            ";

            enviarCorreo($user, $resumenDetalles);
            echo json_encode(['success' => 'Compra realizada con éxito. Se ha enviado un correo con el resumen.']);
        } else {
            echo json_encode(['error' => 'Error al realizar la compra.']);
        }
    }
}
