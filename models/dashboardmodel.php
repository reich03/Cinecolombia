<?php
require_once 'core/model.php';
require_once 'models/moviesmodel.php';
require_once 'models/registermodel.php';

class DashboardModel extends MoviesModel
{
    private $registerModel;

    public function __construct()
    {
        error_log('DashboardModel::construct->Inicializa');
        parent::__construct();
        $this->registerModel = new RegisterModel();
    }
    public function insertMovie($data, $files)
    {
        try {
            $imagePath = $this->uploadFile($files['imagen'], 'images');
            $backgroundPath = $this->uploadFile($files['background'], 'backgrounds');

            $query = $this->db->connect()->prepare('
                INSERT INTO peliculas (
                    titulo, 
                    subtitulo, 
                    sinopsis, 
                    fecha_estreno, 
                    fecha_retiro, 
                    genero, 
                    clasificacion, 
                    duracion, 
                    imagen, 
                    background, 
                    iddirector
                ) VALUES (
                    :titulo, 
                    :subtitulo, 
                    :sinopsis, 
                    :fecha_estreno, 
                    :fecha_retiro, 
                    :genero, 
                    :clasificacion, 
                    :duracion, 
                    :imagen, 
                    :background, 
                    :iddirector
                ) RETURNING idpeliculas
            ');

            $query->execute([
                'titulo' => $data['titulo'],
                'subtitulo' => $data['subtitulo'],
                'sinopsis' => $data['sinopsis'],
                'fecha_estreno' => $data['fecha_estreno'],
                'fecha_retiro' => $data['fecha_retiro'],
                'genero' => $data['genero'],
                'clasificacion' => $data['clasificacion'],
                'duracion' => $data['duracion'],
                'imagen' => $imagePath,
                'background' => $backgroundPath,
                'iddirector' => $data['iddirector']
            ]);

            $movieId = $query->fetch(PDO::FETCH_ASSOC)['idpeliculas'];

            foreach ($data['actores'] as $index => $actorId) {
                $query = $this->db->connect()->prepare('
                    INSERT INTO casting (idpeliculas, idactor, personaje) 
                    VALUES (:idpeliculas, :idactor, :personaje)
                ');
                $query->execute([
                    'idpeliculas' => $movieId,
                    'idactor' => $actorId,
                    'personaje' => $data['personaje_name'][$index]
                ]);
            }

            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::insertMovie->PDOException ' . $e);
            return false;
        }
    }
    public function updateMovie($data, $files)
    {
        try {
            $imagePath = isset($files['imagen']) ? $this->uploadFile($files['imagen'], 'images') : $data['imagen'];
            $backgroundPath = isset($files['background']) ? $this->uploadFile($files['background'], 'backgrounds') : $data['background'];

            $query = $this->db->connect()->prepare('
                UPDATE peliculas SET 
                    titulo = :titulo, 
                    subtitulo = :subtitulo, 
                    sinopsis = :sinopsis, 
                    fecha_estreno = :fecha_estreno, 
                    fecha_retiro = :fecha_retiro, 
                    genero = :genero, 
                    clasificacion = :clasificacion, 
                    duracion = :duracion, 
                    imagen = :imagen, 
                    background = :background, 
                    iddirector = :iddirector 
                WHERE idpeliculas = :id
            ');

            $query->execute([
                'titulo' => $data['titulo'],
                'subtitulo' => $data['subtitulo'],
                'sinopsis' => $data['sinopsis'],
                'fecha_estreno' => $data['fecha_estreno'],
                'fecha_retiro' => $data['fecha_retiro'],
                'genero' => $data['genero'],
                'clasificacion' => $data['clasificacion'],
                'duracion' => $data['duracion'],
                'imagen' => $imagePath,
                'background' => $backgroundPath,
                'iddirector' => $data['iddirector'],
                'id' => $data['idpeliculas']
            ]);

            $query = $this->db->connect()->prepare('DELETE FROM casting WHERE idpeliculas = :idpeliculas');
            $query->execute(['idpeliculas' => $data['idpeliculas']]);

            foreach ($data['actores'] as $index => $actorId) {
                $query = $this->db->connect()->prepare('INSERT INTO casting (idpeliculas, idactor, personaje) VALUES (:idpeliculas, :idactor, :personaje)');
                $query->execute([
                    'idpeliculas' => $data['idpeliculas'],
                    'idactor' => $actorId,
                    'personaje' => $data['personaje_name'][$index]
                ]);
            }

            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::updateMovie->PDOException ' . $e);
            return false;
        }
    }

    public function insertUser($data)
    {
        return $this->registerModel->register(
            $data['email'],
            $data['password'],
            $data['first_name'],
            $data['last_name'],
            $data['phone'],
            $data['first_name'],
            $data['role']
        );
    }

    public function getAllUsers()
    {
        try {
            $query = $this->db->connect()->query('
                SELECT idcliente AS id, nomb_cli AS nombre, ape_cli AS apellido, correo_cli AS correo, telefono, idrol
                FROM cliente
                UNION
                SELECT idempleado AS id, nomb_emple AS nombre, ape_emple AS apellido, correo_emple AS correo, telefono, idrol
                FROM empleado
            ');

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('DashboardModel::getAllUsers->PDOException ' . $e);
            return [];
        }
    }

    public function getUserById($id, $role)
    {
        try {
            if ($role == 1) {
                $query = $this->db->connect()->prepare('SELECT * FROM cliente WHERE idcliente = :id');
            } else {
                $query = $this->db->connect()->prepare('SELECT * FROM empleado WHERE idempleado = :id');
            }

            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('DashboardModel::getUserById->PDOException ' . $e);
            return null;
        }
    }

    public function updateUser($data)
    {
        try {
            if ($data['role'] == 1) {
                $query = $this->db->connect()->prepare('
                    UPDATE cliente SET 
                        nomb_cli = :first_name, 
                        ape_cli = :last_name, 
                        correo_cli = :email, 
                        telefono = :phone, 
                        "user" = :user 
                    WHERE idcliente = :id
                ');
            } else {
                $query = $this->db->connect()->prepare('
                    UPDATE empleado SET 
                        nomb_emple = :first_name, 
                        ape_emple = :last_name, 
                        correo_emple = :email, 
                        telefono = :phone, 
                        "user" = :user 
                    WHERE idempleado = :id
                ');
            }

            $query->execute([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'user' => $data['first_name'],
                'id' => $data['id']
            ]);

            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::updateUser->PDOException ' . $e);
            return false;
        }
    }

    public function deleteUser($id, $role)
    {
        try {
            if ($role == 1) {
                $query = $this->db->connect()->prepare('DELETE FROM cliente WHERE idcliente = :id');
            } else {
                $query = $this->db->connect()->prepare('DELETE FROM empleado WHERE idempleado = :id');
            }

            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::deleteUser->PDOException ' . $e);
            return false;
        }
    }

    public function getAllRooms()
    {
        try {
            $query = $this->db->connect()->query('SELECT * FROM sala');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('DashboardModel::getAllRooms->PDOException ' . $e);
            return [];
        }
    }

    public function getRoomById($id)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM sala WHERE idsala = :id');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('DashboardModel::getRoomById->PDOException ' . $e);
            return null;
        }
    }

    public function insertRoom($data)
    {
        try {
            $query = $this->db->connect()->prepare('
                INSERT INTO sala (nombre_sala, capacidad, cant_prefe, cant_gen, tipo_sala, preferencial) 
                VALUES (:nombre_sala, :capacidad, :cant_prefe, :cant_gen, :tipo_sala, :preferencial)
            ');
            $query->execute([
                'nombre_sala' => $data['nombre_sala'],
                'capacidad' => $data['capacidad'],
                'cant_prefe' => $data['cant_prefe'],
                'cant_gen' => $data['cant_gen'],
                'tipo_sala' => $data['tipo_sala'],
                'preferencial' => $data['preferencial']
            ]);
            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::insertRoom->PDOException ' . $e);
            return false;
        }
    }

    public function updateRoom($data)
    {
        try {
            $query = $this->db->connect()->prepare('
                UPDATE sala SET 
                    nombre_sala = :nombre_sala, 
                    capacidad = :capacidad, 
                    cant_prefe = :cant_prefe, 
                    cant_gen = :cant_gen, 
                    tipo_sala = :tipo_sala, 
                    preferencial = :preferencial 
                WHERE idsala = :id
            ');
            $query->execute([
                'nombre_sala' => $data['nombre_sala'],
                'capacidad' => $data['capacidad'],
                'cant_prefe' => $data['cant_prefe'],
                'cant_gen' => $data['cant_gen'],
                'tipo_sala' => $data['tipo_sala'],
                'preferencial' => $data['preferencial'],
                'id' => $data['idsala']
            ]);
            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::updateRoom->PDOException ' . $e);
            return false;
        }
    }

    public function deleteRoom($id)
    {
        try {
            $query = $this->db->connect()->prepare('DELETE FROM sala WHERE idsala = :id');
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::deleteRoom->PDOException ' . $e);
            return false;
        }
    }

    public function getAllFunctions()
    {
        try {
            $query = $this->db->connect()->query('SELECT * FROM funciones');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('DashboardModel::getAllFunctions->PDOException ' . $e);
            return [];
        }
    }

    public function isRoomAvailable($hora_inicio, $hora_fin, $fecha, $idsala, $idfuncion = null)
    {
        try {
            $queryStr = '
            SELECT COUNT(*) as count FROM funciones 
            WHERE idsala = :idsala 
            AND fecha = :fecha 
            AND (
                (hora_inicio < :hora_fin AND hora_fin > :hora_inicio)
                OR (hora_inicio < :hora_fin AND hora_fin > :hora_inicio)
            )';

            if ($idfuncion) {
                $queryStr .= ' AND idfuncion != :idfuncion';
            }

            $query = $this->db->connect()->prepare($queryStr);

            $params = [
                'idsala' => $idsala,
                'fecha' => $fecha,
                'hora_inicio' => $hora_inicio,
                'hora_fin' => $hora_fin,
            ];

            if ($idfuncion) {
                $params['idfuncion'] = $idfuncion;
            }

            $query->execute($params);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result['count'] == 0;
        } catch (PDOException $e) {
            error_log('DashboardModel::isRoomAvailable->PDOException ' . $e);
            return false;
        }
    }
    public function getOcupiedSeatsByFunction($idFuncion)
    {
        try {
            if (is_array($idFuncion) && isset($idFuncion[0])) {
                $idFuncion = intval($idFuncion[0]);
            }

            error_log('Tipo de $idFuncion: ' . gettype($idFuncion));
            error_log('Valor de $idFuncion: ' . var_export($idFuncion, true));

            if (!is_int($idFuncion)) {
                throw new InvalidArgumentException("El parámetro idFuncion debe ser un entero.");
            }

            $query = $this->db->connect()->prepare('
                SELECT idasiento 
                FROM ventas 
                WHERE idfuncion = :idfuncion
            ');
            $query->execute(['idfuncion' => $idFuncion]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return array_column($result, 'idasiento');
        } catch (PDOException $e) {
            error_log('MoviesModel::getOcupiedSeatsByFunction->PDOException ' . $e);
            return [];
        } catch (InvalidArgumentException $e) {
            error_log('MoviesModel::getOcupiedSeatsByFunction->InvalidArgumentException ' . $e->getMessage());
            return [];
        }
    }





    public function insertFunction($data)
    {
        try {
            error_log('Data received for insertFunction: ' . print_r($data, true));

            if (!$this->isRoomAvailable($data['hora_inicio'], $data['hora_fin'], $data['fecha'], $data['idsala'])) {
                error_log('DashboardModel::insertFunction->Room not available');
                return false;
            }

            $query = $this->db->connect()->prepare('
                INSERT INTO funciones (hora_inicio, hora_fin, fecha, idpeliculas, idsala)
                VALUES (:hora_inicio, :hora_fin, :fecha, :idpeliculas, :idsala)
            ');
            $query->execute([
                'hora_inicio' => $data['hora_inicio'],
                'hora_fin' => $data['hora_fin'],
                'fecha' => $data['fecha'],
                'idpeliculas' => $data['idpeliculas'],
                'idsala' => $data['idsala']
            ]);
            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::insertFunction->PDOException ' . $e);
            return false;
        }
    }

    public function updateFunction($data)
    {
        try {
            error_log('Data received for updateFunction: ' . print_r($data, true));

            if (!$this->isRoomAvailable($data['hora_inicio'], $data['hora_fin'], $data['fecha'], $data['idsala'], $data['idfuncion'])) {
                error_log('DashboardModel::updateFunction->Room not available');
                return false;
            }

            $query = $this->db->connect()->prepare('
                UPDATE funciones SET 
                    hora_inicio = :hora_inicio, 
                    hora_fin = :hora_fin, 
                    fecha = :fecha, 
                    idpeliculas = :idpeliculas, 
                    idsala = :idsala 
                WHERE idfuncion = :id
            ');
            $query->execute([
                'hora_inicio' => $data['hora_inicio'],
                'hora_fin' => $data['hora_fin'],
                'fecha' => $data['fecha'],
                'idpeliculas' => $data['idpeliculas'],
                'idsala' => $data['idsala'],
                'id' => $data['idfuncion']
            ]);
            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::updateFunction->PDOException ' . $e);
            return false;
        }
    }



    public function deleteFunction($id)
    {
        try {
            $query = $this->db->connect()->prepare('DELETE FROM funciones WHERE idfuncion = :id');
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::deleteFunction->PDOException ' . $e);
            return false;
        }
    }

    public function getFunctionById($id)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM funciones WHERE idfuncion = :id');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('DashboardModel::getFunctionById->PDOException ' . $e);
            return null;
        }
    }
}
