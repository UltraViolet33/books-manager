<?php

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

        if (file_exists("../app/view/" . $path . ".php")) {
            include "../app/view/" . $path . ".php";
        } else {
            include "../app/view/404.php";
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
        if (file_exists("../app/model/" .  strtolower($model) . ".php")) {
            include "../app/model/" . strtolower($model) . ".php";
            return $a = new $model();
        }
        return false;
    }
}
