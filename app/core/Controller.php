<?php


namespace App\core;

abstract class Controller
{
    const VIEW_PATH  = ROOT_PATH . "app" . DIRECTORY_SEPARATOR . "views";


    abstract public function index(): void; 

    abstract public function add(): void;

    abstract public function edit(int $id): void;

    abstract public function delete(): void;

   

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

        if (file_exists(Controller::VIEW_PATH . DIRECTORY_SEPARATOR . $path . ".php")) {
            include Controller::VIEW_PATH . DIRECTORY_SEPARATOR . $path . ".php";
        } else {
            include Controller::VIEW_PATH . DIRECTORY_SEPARATOR . "404.php";
        }
    }


    /**
     * loadModel
     * load a model file
     * @param string $model
     * @return object|bool
     */
    // public function loadModel($model): object|bool
    // {
    //     if (file_exists("../app/models/" .  strtolower($model) . ".php")) {
    //         include "../app/models/" . strtolower($model) . ".php";
    //         return $a = new $model();
    //     }
    //     return false;
    // }
}
