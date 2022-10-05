<?php


namespace App\core;

class Controller
{
    /**
     * view
     * load a view file
     * @param string $path
     * @param array $data
     * @return void
     */
    public function view(string $path, array $data = [])
    {
        extract($data);
        var_dump("C:\laragon\www\books-crud\app".DIRECTORY_SEPARATOR."views". DIRECTORY_SEPARATOR . $path . ".php");

        if (file_exists("C:\laragon\www\books-crud\app".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR. $path . ".php")) {
            var_dump('ok');
            include "C:\laragon\www\books-crud\app".DIRECTORY_SEPARATOR."views". DIRECTORY_SEPARATOR . $path . ".php";
        } else {
            include "../app/views/404.php";
        }
    }


    /**
     * loadModel
     * load a model file
     * @param string $model
     * @return object|bool
     */
    public function loadModel($model): object|bool
    {
        if (file_exists("../app/models/" .  strtolower($model) . ".php")) {
            include "../app/models/" . strtolower($model) . ".php";
            return $a = new $model();
        }
        return false;
    }
}
