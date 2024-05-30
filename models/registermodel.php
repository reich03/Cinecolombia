<?php

require_once 'core/model.php';

class RegisterModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
    }

    public function register($email, $password, $first_name, $last_name, $phone, $user, $role)
    {
        try {
            if ($role == 1) {
                $table = 'cliente';
                $fields = [
                    'correo' => 'correo_cli',
                    'clave' => 'clave_cli',
                    'nombre' => 'nomb_cli',
                    'apellido' => 'ape_cli',
                    'telefono' => 'telefono',
                    'user' => 'user',
                    'rol' => 'idrol'
                ];
            } else {
                $table = 'empleado';
                $fields = [
                    'correo' => 'correo_emple',
                    'clave' => 'clave_emple',
                    'nombre' => 'nomb_emple',
                    'apellido' => 'ape_emple',
                    'telefono' => 'telefono',
                    'user' => 'user',
                    'rol' => 'idrol'
                ];
            }

            $query = $this->db->connect()->prepare("
            INSERT INTO $table (
                {$fields['correo']}, 
                {$fields['clave']}, 
                {$fields['nombre']}, 
                {$fields['apellido']}, 
                {$fields['telefono']}, 
                \"{$fields['user']}\", 
                {$fields['rol']}
            ) VALUES (
                :email, 
                :password, 
                :first_name, 
                :last_name, 
                :phone, 
                :user, 
                :idrol
            )
        ");

            $query->execute([
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone,
                'user' => $user,
                'idrol' => $role
            ]);

            return true;
        } catch (PDOException $e) {
            error_log('RegisterModel::register->PDOException ' . $e);
            return false;
        }
    }
}
