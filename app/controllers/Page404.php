<?php


namespace App\controllers;

use App\core\Controller;


class Page404 extends Controller
{
    public function index()
    {
        $this->view('page404');
    }
}
