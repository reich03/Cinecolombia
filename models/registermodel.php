<?php

require_once 'core/model.php';

class RegisterModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register($email, $password, $first_name, $last_name, $phone)
    {
        try {
            $query = $this->db->connect()->prepare('INSERT INTO cliente (correo_cli, clave_cli, nomb_cli, ape_cli, telefono, "user", idrol) VALUES (:email, :password, :first_name, :last_name, :phone, :user, :idrol)');
            $query->execute([
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone,
                'user' => $first_name,
                'idrol' => 1
            ]);
            return true;
        } catch (PDOException $e) {
            error_log('RegisterModel::register->PDOException ' . $e);
            return false;
        }
    }
}
