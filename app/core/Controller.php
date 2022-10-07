<?php

namespace App\core;

use App\models\Table;

abstract class Controller
{
    const VIEW_PATH  = ROOT_PATH . "app" . DIRECTORY_SEPARATOR . "views";
    
    protected Table $model;
    
    
    /**
     * index
     *
     * @return void
     */
    abstract public function index(): void;
    
    
    /**
     * add
     *
     * @return void
     */
    abstract public function add(): void;
    
    
    /**
     * edit
     *
     * @param int $id
     * @return void
     */
    abstract public function edit(int $id): void;

    
    /**
     * delete
     *
     * @return void
     */
    abstract public function delete(): void;


    /**
     * view
     * load a view file
     * @param string $path
     * @param array $data
     * @return void
     */
    public function view(string $path, array $data = []): void
    {
        extract($data);

        if (file_exists(Controller::VIEW_PATH . DIRECTORY_SEPARATOR . $path . ".php")) {

            include Controller::VIEW_PATH . DIRECTORY_SEPARATOR . $path . ".php";
        } else {
            include Controller::VIEW_PATH . DIRECTORY_SEPARATOR . "404.php";
        }
    }


    /**
     * checkError
     *
     * @return void
     */
    protected function checkError(): void
    {
        $errors = "";
        $htmlError = "";

        if (isset($_SESSION['error']) && is_array($_SESSION['error'])) {
            foreach ($_SESSION['error'] as $nameError => $error) {
                foreach ($error as $msgError) {
                    $errors .= "$msgError<br>";
                }
            }

            $htmlError .= '<div class="bg-danger p-3">
                                <span style="font-size:24px" >' . $errors . '</span>
                            </div>';
        }

        unset($_SESSION['error']);
        echo $htmlError;
    }


    /**
     * validateData
     *
     * @param  mixed $data
     * @return mixed
     */
    protected function validateData(mixed $data): mixed
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }
}
