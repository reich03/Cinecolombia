<?php 

require_once 'core/model.php';

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($username, $password)
    {
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM cliente WHERE correo_cli = :correo_cli OR nomb_cli = :nomb_cli');
            $query->execute(['correo_cli' => $username, 'nomb_cli' => $username]);

            if ($query->rowCount() > 0) {
                $user = $query->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $user['clave_cli'])) {
                    error_log("model-user-login::login->Informacion exitosa ,$user[correo_cli]");
                    return $user;
                } else {
                    return null;
                }
            }

            return null;
        } catch (PDOException $e) {
            error_log('UserModel::login->PDOException ' . $e);
            return null;
        }
    }
}
