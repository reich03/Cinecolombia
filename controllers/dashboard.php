<?php

class Dashboard extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->view->render('dashboard/index');
    }

    function movies()
    {
        $this->view->render('dashboard/movies');
    }

    function rooms()
    {
        $this->view->render('dashboard/rooms');
    }

    function users()
    {
        $this->view->render('dashboard/users');
    }

    function statistics()
    {
        $this->view->render('dashboard/statistics');
    }
}
?>
