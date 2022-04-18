<?php

class Controller
{
    /**
     * view
     * load a view file
     * @return void
     */
    public function view($path, $data = [])
    {
        extract($data);

        if (file_exists("../app/view/" . $path . ".php")) {
            include "../app/view/" . $path . ".php";
        } else {
            echo "tes";
            die;
            include "../app/view/404.php";
        }
    }

    /**
     * loadModel
     * load a model file
     * @return object
     */
    public function loadModel($model)
    {
        if (file_exists("../app/model/" .  strtolower($model) . ".php")) {
            include "../app/model/" . strtolower($model) . ".php";
            return $a = new $model();
        }
        return false;
    }
}