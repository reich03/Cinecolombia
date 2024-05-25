<?php


class App
{
    // Constructor para definir el enrutamiento del login
    function __construct()
    {
        // Verificar si hay un valor en el GET de la URL, si lo hay, se asigna, si no, se asigna null
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        // Se elimina cualquier '/' al final para normalizar
        $url = rtrim($url, '/');
        // Se delimita la URL mediante '/' y se almacena en un array
        $url = explode('/', $url);

        // Incluir el controlador de errores
        require_once('controllers/errores.php');

        if (empty($url[0])) {
            // Si no hay un controlador especificado, cargar el controlador principal (Main)
            error_log('APP::construct->No hay controlador Especificado');
            $archivoController = "controllers/main.php";
            require_once $archivoController;
            $controller = new Main();
            $controller->LoadModel('main');
            $controller->render();
            return; // Asegurarse de retornar para que no continúe la ejecución
        }

        $archivoController = 'controllers/' . $url[0] . '.php';
        if (file_exists($archivoController)) {
            // Si el archivo del controlador existe, se carga
            require_once $archivoController;
            $controller = new $url[0];
            $controller->LoadModel($url[0]);

            // Validar si en la URL el método a cargar está definido, si no, cargar uno por defecto
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    if (isset($url[2])) {
                        // Llamar al método pasando parámetros

                        // Número de parámetros
                        $nparam = count($url) - 2;

                        // Arreglo de parámetros
                        $params = [];
                        for ($i = 0; $i < $nparam; $i++) {
                            array_push($params, $url[$i + 2]);
                        }

                        $controller->{$url[1]}($params);
                    } else {
                        // Llamar al método por defecto al no pasarle parámetros
                        $controller->{$url[1]}();
                    }
                } else {
                    // Error, no existe el método
                    error_log('APP::construct->No existe el metodo Especificado');
                    $controller = new Error404();
                    $controller->render();
                }
            } else {
                // No hay método definido, se carga el por defecto
                $controller->render();
            }
        } else {
            // Error, no existe el controlador
            error_log('APP::construct->No existe el controlador');
            $controller = new Error404();
            $controller->render();
        }
    }
}
