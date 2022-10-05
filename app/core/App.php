<?php


namespace App\core;

use App\core\Controller;
use App\controllers\Page404;

class App
{
    private $controller;
    protected $method = "index";
    protected $params;

    const PATH_TO_CONTROLLERS = ROOT_PATH . "\app\controllers" . DIRECTORY_SEPARATOR;

    const NAMESPACE_CONTROLLERS = "App" . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR;

    /**
     * __construct
     * load the controller and the method
     * @return void
     */
    public function __construct()
    {
        // $_GET['url'] = "book/index";
        $url = $this->parseURL();

        $this->controller =  $this->getController($url);

        $this->method = $this->getMethod($url);



        // // //check if the file exists
        // if (file_exists("C:\laragon\www\books-crud\app\controllers" . DIRECTORY_SEPARATOR . strtolower($url[0]) . "Controller.php")) {

        //     // if (file_exists("../app/controllers/BookController.php")) {
        //     //     echo "ok";

        //     $this->controller = ($url[0]) . "Controller";
        //     unset($url[0]);

        //     $fullController = "App" . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . $this->controller;

        //     if (class_exists($fullController)) {
        //         $this->controller = new $fullController;
        //     }
        // } else {
        //     $this->controller = "Page404";
        // }

        // // require("../app/controllers/" . $this->controller . ".php");


        // if (isset($url[1])) {
        //     $url[1] = strtolower($url[1]);
        //     if (method_exists($this->controller, $url[1])) {
        //         $this->method = $url[1];
        //         unset($url[1]);
        //     }
        // }

        $this->params = (count($url) > 0) ? $url : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * parseURL
     * @return array
     */
    private function parseURL(): array
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "book";
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }


    private function getController(array $url): Controller
    {

        if (file_exists(App::PATH_TO_CONTROLLERS . strtolower($url[0]) . "Controller.php")) {

            $controller = ucfirst($url[0]) . "Controller";
            $fullController = App::NAMESPACE_CONTROLLERS . $controller;

            if (class_exists($fullController)) {
                $controller = new $fullController();

                return $controller;
            }
        }

        return  new Page404();
    }




    private function getMethod($url)
    {
        if (isset($url[1])) {
            $url[1] = strtolower($url[1]);
            if (method_exists($this->controller, $url[1])) {
                $method = $url[1];
                unset($url[1]);

                return $method;
            }
        }

        $method = "index";
        return $method;
    }
}
