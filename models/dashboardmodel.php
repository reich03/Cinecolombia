<?php
require_once 'core/model.php';
require_once 'models/moviesmodel.php';
class DashboardModel extends MoviesModel
{
    function __construct()
    {
        error_log('DashboardModel::construct->Inicializa');
        parent::__construct();
    }

    public function insertMovie($data, $files)
    {
        try {
            $imagePath = $this->uploadFile($files['imagen'], 'images');
            $backgroundPath = $this->uploadFile($files['background'], 'backgrounds');

            $query = $this->db->connect()->prepare('INSERT INTO peliculas (titulo, subtitulo, fecha_estreno, genero, clasificacion, duracion, imagen, background, iddirector) VALUES (:titulo, :subtitulo, :fecha_estreno, :genero, :clasificacion, :duracion, :imagen, :background, :iddirector)');
            $query->execute([
                'titulo' => $data['titulo'],
                'subtitulo' => $data['subtitulo'],
                'fecha_estreno' => $data['fecha_estreno'],
                'genero' => $data['genero'],
                'clasificacion' => $data['clasificacion'],
                'duracion' => $data['duracion'],
                'imagen' => $imagePath,
                'background' => $backgroundPath,
                'iddirector' => $data['iddirector']
            ]);

            $movieId = $this->db->connect()->lastInsertId();

            foreach ($data['actores'] as $actorId) {
                $query = $this->db->connect()->prepare('INSERT INTO casting (idpeliculas, idactor) VALUES (:idpeliculas, :idactor)');
                $query->execute(['idpeliculas' => $movieId, 'idactor' => $actorId]);
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
            $imagePath = $this->uploadFile($files['imagen'], 'images');
            $backgroundPath = $this->uploadFile($files['background'], 'backgrounds');

            $query = $this->db->connect()->prepare('UPDATE peliculas SET titulo = :titulo, subtitulo = :subtitulo, fecha_estreno = :fecha_estreno, genero = :genero, clasificacion = :clasificacion, duracion = :duracion, imagen = :imagen, background = :background, iddirector = :iddirector WHERE idpeliculas = :id');
            $query->execute([
                'titulo' => $data['titulo'],
                'subtitulo' => $data['subtitulo'],
                'fecha_estreno' => $data['fecha_estreno'],
                'genero' => $data['genero'],
                'clasificacion' => $data['clasificacion'],
                'duracion' => $data['duracion'],
                'imagen' => $imagePath,
                'background' => $backgroundPath,
                'iddirector' => $data['iddirector'],
                'id' => $data['idpeliculas']
            ]);

            // Delete old actors
            $query = $this->db->connect()->prepare('DELETE FROM casting WHERE idpeliculas = :idpeliculas');
            $query->execute(['idpeliculas' => $data['idpeliculas']]);

            // Insert new actors
            foreach ($data['actores'] as $actorId) {
                $query = $this->db->connect()->prepare('INSERT INTO casting (idpeliculas, idactor) VALUES (:idpeliculas, :idactor)');
                $query->execute(['idpeliculas' => $data['idpeliculas'], 'idactor' => $actorId]);
            }

            return true;
        } catch (PDOException $e) {
            error_log('DashboardModel::updateMovie->PDOException ' . $e);
            return false;
        }
    }

    public function uploadFile($file, $directory)
    {
        if ($file['error'] == UPLOAD_ERR_OK) {
            $targetDir = __DIR__ . '/../uploads/' . $directory . '/';
            $targetFile = $targetDir . basename($file['name']);
            move_uploaded_file($file['tmp_name'], $targetFile);
            return $targetFile;
        }
        return null;
    }
}
