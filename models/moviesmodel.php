<?php
require_once __DIR__ . '/../core/model.php';

class MoviesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllMovies()
    {
        try {
            $query = $this->db->connect()->query('
            SELECT 
                p.*, 
                COALESCE(json_agg(
                    json_build_object(
                        \'idactor\', a.idactor, 
                        \'nombre\', a.nombre, 
                        \'apellido\', a.apellido, 
                        \'personaje\', c.personaje
                    )
                ) FILTER (WHERE a.idactor IS NOT NULL), \'[]\') as actores,
                json_build_object(
                    \'iddirector\', d.iddirector, 
                    \'nombre\', d.nombre, 
                    \'apellido\', d.apellido
                ) as director
            FROM peliculas p
            LEFT JOIN casting c ON p.idpeliculas = c.idpeliculas
            LEFT JOIN actores a ON c.idactor = a.idactor
            LEFT JOIN directores d ON p.iddirector = d.iddirector
            GROUP BY p.idpeliculas, d.iddirector
        ');

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MoviesModel::getAllMovies->PDOException ' . $e);
            return [];
        }
    }

    public function getMoviesFlyer()
    {
        try {
            $query = $this->db->connect()->query('
        SELECT 
            p.*, 
            COALESCE(json_agg(
                json_build_object(
                    \'idactor\', a.idactor, 
                    \'nombre\', a.nombre, 
                    \'apellido\', a.apellido, 
                    \'personaje\', c.personaje
                )
            ) FILTER (WHERE a.idactor IS NOT NULL), \'[]\') as actores,
            json_build_object(
                \'iddirector\', d.iddirector, 
                \'nombre\', d.nombre, 
                \'apellido\', d.apellido
            ) as director
        FROM peliculas p
        LEFT JOIN casting c ON p.idpeliculas = c.idpeliculas
        LEFT JOIN actores a ON c.idactor = a.idactor
        LEFT JOIN directores d ON p.iddirector = d.iddirector
        GROUP BY p.idpeliculas, d.iddirector
        LIMIT 8
    ');

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MoviesModel::getMoviesFlyer->PDOException ' . $e);
            return [];
        }
    }


    public function getAllSales()
    {
        try {
            $query = $this->db->connect()->query("
            SELECT 
                p.titulo,
                f.fecha,
                f.hora_inicio AS hora,
                s.nombre_sala AS sala,
                COUNT(v.idventa) AS cantidad,
                SUM(v.precionentrada) AS total
            FROM ventas v
            JOIN funciones f ON v.idfuncion = f.idfuncion
            JOIN peliculas p ON f.idpeliculas = p.idpeliculas
            JOIN sala s ON f.idsala = s.idsala
            GROUP BY p.titulo, f.fecha, f.hora_inicio, s.nombre_sala
        ");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('DashboardModel::getAllSales->PDOException ' . $e);
            return [];
        }
    }

    public function getMonthlyRevenue()
    {
        try {
            $query = $this->db->connect()->query("
                SELECT 
                    TO_CHAR(fecha_venta, 'Month') AS mes, 
                    SUM(precionentrada) AS ingresos
                FROM ventas
                GROUP BY TO_CHAR(fecha_venta, 'Month')
                ORDER BY TO_CHAR(fecha_venta, 'Month')
            ");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MoviesModel::getMonthlyRevenue->PDOException ' . $e);
            return [];
        }
    }

    public function getTopMovies()
    {
        try {
            $query = $this->db->connect()->query("
                SELECT 
                    p.titulo, 
                    SUM(v.precionentrada) AS ingresos
                FROM ventas v
                JOIN funciones f ON v.idfuncion = f.idfuncion
                JOIN peliculas p ON f.idpeliculas = p.idpeliculas
                GROUP BY p.titulo
                ORDER BY ingresos DESC
                LIMIT 5
            ");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('DashboardModel::getTopMovies->PDOException ' . $e);
            return [];
        }
    }

    public function getTopUsers($limit = 3)
    {
        try {
            $query = $this->db->connect()->query("
                SELECT 
                    CONCAT(c.nomb_cli, ' ', c.ape_cli) AS nombre, 
                    COUNT(v.idventa) AS entradas
                FROM ventas v
                JOIN cliente c ON v.idcliente = c.idcliente
                GROUP BY nombre
                ORDER BY entradas DESC
                LIMIT $limit
            ");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MoviesModel::getTopUsers->PDOException ' . $e);
            return [];
        }
    }

    public function getSalesByUser($id)
    {
        try {
            $query = $this->db->connect()->prepare("
                SELECT 
                    p.titulo,
                    f.fecha,
                    f.hora_inicio AS hora,
                    s.nombre_sala AS sala,
                    COUNT(v.idventa) AS cantidad,
                    SUM(v.precionentrada) AS total
                FROM ventas v
                JOIN funciones f ON v.idfuncion = f.idfuncion
                JOIN peliculas p ON f.idpeliculas = p.idpeliculas
                JOIN sala s ON f.idsala = s.idsala
                WHERE v.idcliente = :id
                GROUP BY p.titulo, f.fecha, f.hora_inicio, s.nombre_sala
            ");
            $query->execute(['id' => $id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MoviesModel::getSalesByUser->PDOException ' . $e);
            return [];
        }
    }


    public function getMovieById($id)
    {
        try {
            $query = $this->db->connect()->prepare('
                SELECT 
                    p.*, 
                    json_agg(
                        json_build_object(
                            \'idactor\', a.idactor, 
                            \'nombre\', a.nombre, 
                            \'apellido\', a.apellido, 
                            \'personaje\', c.personaje
                        )
                    ) as actores,
                    json_build_object(
                        \'iddirector\', d.iddirector, 
                        \'nombre\', d.nombre, 
                        \'apellido\', d.apellido
                    ) as director
                FROM peliculas p
                LEFT JOIN casting c ON p.idpeliculas = c.idpeliculas
                LEFT JOIN actores a ON c.idactor = a.idactor
                LEFT JOIN directores d ON p.iddirector = d.iddirector
                WHERE p.idpeliculas = :id
                GROUP BY p.idpeliculas, d.iddirector
            ');

            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MoviesModel::getMovieById->PDOException ' . $e);
            return null;
        }
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

    public function deleteMovie($id)
    {
        try {
            $query = $this->db->connect()->prepare('DELETE FROM casting WHERE idpeliculas = :id');
            $query->execute(['id' => $id]);

            $query = $this->db->connect()->prepare('DELETE FROM peliculas WHERE idpeliculas = :id');
            return $query->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log('MoviesModel::deleteMovie->PDOException ' . $e);
            return false;
        }
    }


    public function uploadFile($file, $directory)
    {
        if ($file['error'] == UPLOAD_ERR_OK) {
            $targetDir = __DIR__ . '/../../uploads/' . $directory . '/';
            $this->createDirectoryIfNotExists($targetDir);
            $targetFile = $targetDir . basename($file['name']);
            move_uploaded_file($file['tmp_name'], $targetFile);
            return '/uploads/' . $directory . '/' . basename($file['name']);
        }
        return null;
    }

    private function createDirectoryIfNotExists($directory)
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    public function getAllDirectors()
    {
        try {
            $query = $this->db->connect()->query('SELECT * FROM directores');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MoviesModel::getAllDirectors->PDOException ' . $e);
            return [];
        }
    }

    public function getAllActors()
    {
        try {
            $query = $this->db->connect()->query('SELECT * FROM actores');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('MoviesModel::getAllActors->PDOException ' . $e);
            return [];
        }
    }

    public function createSale($ventaData)
    {
        try {
            $pdo = $this->db->connect();
            $pdo->beginTransaction();

            $asientoQuery = $pdo->prepare('
                INSERT INTO asientos (idasiento, estado, claseasiento, idsala) 
                VALUES (:idasiento, true, :claseasiento, :idsala)
                ON CONFLICT (idasiento) DO NOTHING
            ');

            foreach ($ventaData['asientos'] as $asiento) {
                $asientoQuery->execute([
                    'idasiento' => $asiento['id'],
                    'claseasiento' => $asiento['clase'],
                    'idsala' => $ventaData['idsala']
                ]);
            }

            $query = $pdo->prepare('
                INSERT INTO ventas (
                    fecha_venta, 
                    idfuncion, 
                    idcliente, 
                    idempleado, 
                    precionentrada, 
                    idasiento
                ) VALUES (
                    NOW(), 
                    :idfuncion, 
                    :idcliente, 
                    :idempleado, 
                    :precionentrada, 
                    :idasiento
                )
            ');

            foreach ($ventaData['asientos'] as $asiento) {
                $query->execute([
                    'idfuncion' => $ventaData['idfuncion'],
                    'idcliente' => $ventaData['idcliente'],
                    'idempleado' => $ventaData['idempleado'],
                    'precionentrada' => $ventaData['precionentrada'],
                    'idasiento' => $asiento['id']
                ]);

                $updateQuery = $pdo->prepare('UPDATE asientos SET estado = false WHERE idasiento = :idasiento');
                $updateQuery->execute(['idasiento' => $asiento['id']]);
            }

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            error_log('MoviesModel::createSale->PDOException ' . $e);
            return false;
        }
    }
}
