<?php

require_once('../app/core/controller.php');

class Category extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model  = $this->loadModel("CategoryTable");
    }

    /**
     * index
     * display category view
     */
    public function index()
    {
        // $categoryTable = $this->loadModel("CategoryTable");
        $categories = $this->model->getAll();
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
                // $categoryTable = $this->loadModel("CategoryTable");
                $name = validateData($_POST['name']);
                if ($this->model->insert($name)) {
                    header("Location: " . ROOT . "category");
                    return;
                }
            } else {
                $_SESSION['error'] = "Name input must be filled <br>";
            }
        }
        $this->view("categories/add");
    }

    public function delete()
    {
        if (isset($_POST['deleteCat'])) {
            if (!empty($_POST['id'])) {
                $id = (int)$_POST['id'];
                if ($id === 0) {
                    header("Location: " . ROOT . "category");
                    return;
                } elseif (is_int($id) && $id !== 0) {
                    $this->model->deleteCategory($id);
                    header("Location: " . ROOT . "category");
                    return;
                }
            }
        }
    }
}
