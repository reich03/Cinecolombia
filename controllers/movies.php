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

    function createSale()
    {
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

        $asientos = array_map(function ($asiento) {
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
                <div style='background-color: #f4f4f4; padding: 20px; font-family: Arial, sans-serif;'>
                    <div style='background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>
                        <h2 style='color: #1c508d; text-align: center;'>Cine Colombia</h2>
                        <h4 style='color: #333333; text-align: center;'>Resumen de Compra</h4>
                        <p style='color: #555555;'><strong>Usuario:</strong> {$user['nombre']} {$user['apellido']}</p>
                        <p style='color: #555555;'><strong>Correo:</strong> {$user['correo']}</p>
                        <p style='color: #555555;'><strong>Película:</strong> {$data['titulo']}</p>
                        <p style='color: #555555;'><strong>Fecha:</strong> {$data['fecha']}</p>
                        <p style='color: #555555;'><strong>Hora:</strong> {$data['hora']}</p>
                        <p style='color: #555555;'><strong>Sala:</strong> {$data['sala']}</p>
                        <p style='color: #555555;'><strong>Asientos:</strong> " . implode(', ', array_column($asientos, 'id')) . "</p>
                        <p style='color: #555555;'><strong>Total:</strong> {$data['precionentrada']}</p>
                    </div>
                </div>
            ";

            enviarCorreo($user, $resumenDetalles);
            echo json_encode(['success' => 'Compra realizada con éxito. Se ha enviado un correo con el resumen.']);
        } else {
            echo json_encode(['error' => 'Error al realizar la compra.']);
        }
    }
    function getSalesByUser()
    {
        session_start();
        $userId = $_SESSION['user']['id'];

        $purchases = $this->model->getSalesByUser($userId);

        echo json_encode($purchases);
    }
}
