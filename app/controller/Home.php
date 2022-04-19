<?php

require_once('../app/core/controller.php');

class Home extends Controller
{

    /**
     * index
     * display home view
     */
    public function index()
    {
        $this->view('index');
    }
}
