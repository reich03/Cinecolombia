<?php

class Controller
{
    function __construct()
    {
        $this->view = new View();
    }

    function loadModel($model)
    {
        $url = 'models/' . $model . 'models.php';

        if (file_exists($url)) {
            require_once $url;

            $modelName = $model . 'Model';
            $this->model = new $modelName();
        }
    }

    function existPost($params){
        foreach ($params as $param){
          if (!isset($_POST[$param])){
             error_log('Controller::existsPosts-> No existe el parametro '.$param);
         return false;
          }
        }
        return true;
    }

    function existGet($params){
        foreach ($params as $param){
            if (!isset($_GET[$param])){
                error_log('Controller::existsGet-> No existe el parametro '.$param);
                return false;
            }
        }
        return true;
    }

    function getGet($name){
        return $_GET[$name];
    }

    function getPost($name){
        return $_POST[$name];
    }

    function redirect($route, $messages){
        $data=[];
        $params='';
        foreach ($messages as $key => $message){
            array_push($data,$key.'='.$message);

        }
        $params=join('&',$data);
        if ($params !==''){
            $params='?'.$params;

        }
        header('Location: '.constant('URL'). $route.$params);
    }

}
