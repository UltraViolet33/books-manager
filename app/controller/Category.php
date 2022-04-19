<?php

require_once('../app/core/controller.php');

class Category extends Controller
{

    /**
     * index
     * display category view
     */
    public function index()
    {
        $categoryTable = $this->loadModel("CategoryTable");
        $categories = $categoryTable->getAll();
        $data['categories'] = $categories;
        extract($data);
        $this->view('categories/index', $data);
    }

    /**
     * add
     * add a category in the BDD
     */
    public function add()
    {
        if (isset($_POST['addCat'])) {
            if (!empty($_POST['name'])) {
                $categoryTable = $this->loadModel("CategoryTable");
                if ($categoryTable->insert($_POST['name'])) {
                    header("Location: " . ROOT . "category");
                    return;
                }
            } else {
                $_SESSION['error'] = "Name input must be filled <br>";
            }
        }
        $this->view("categories/add");
    }
}
