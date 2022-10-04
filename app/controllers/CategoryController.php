<?php


namespace App\controllers;

use App\core\Controller;
use App\models\Category;

class CategoryController extends Controller
{

    private $model;

    public function __construct()
    {
        // $this->model  = $this->loadModel("Category");
        $this->model = new Category();
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

    /**
     * delete
     * delete a category in the BDD
     */
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

    /**
     * edit
     * edit a category in the BDD
     * @param int $id
     */
    public function edit($id)
    {
        if (!is_numeric($id) || $id == 0) {
            header("Location: " . ROOT . "category");
            return;
        }

        if (isset($_POST['editCat'])) {
            if (!empty($_POST['name'])) {
                $name = validateData($_POST['name']);
                $this->model->updateCategory($id, $name);
                header("Location: " . ROOT . "category");
                return;
            } else {
                $_SESSION['error'] = "Name input must be filled <br>";
            }
        }
        $id = (int)$id;
        $category = $this->model->selectCategory($id);
        $data['category'] = $category;
        extract($data);
        $this->view("categories/edit", $data);
    }
}
