<?php 


class Register Extends Controller{

    function __construct()
    {
        parent::__construct();
        //Manera de definir Los errores, Pasamos la clase el metodo y la alerta respectiva
        error_log('register::construct->Inicio de main o vista principal');
    }

    function render()
    {
        error_log('register::render->Index de registro');
        $this->view->render('register/index');
    }
}