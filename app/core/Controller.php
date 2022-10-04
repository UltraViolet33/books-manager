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

        if (file_exists("../app/views/" . $path . ".php")) {
            include "../app/views/" . $path . ".php";
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
