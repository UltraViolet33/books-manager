<?php


namespace App\controllers;

use App\core\Controller;
use App\models\Category;

class CategoryController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Category();
    }

    /**
     * index
     * display category view
     */
    public function index(): void
    {
        $categories = $this->model->getAll();
        $data['categories'] = $categories;
        $this->view('categories/index', $data);
    }

    /**
     * add
     * add a category in the BDD
     */
    public function add(): void
    {
        if (isset($_POST['addCat'])) {
            if (!empty($_POST['name'])) {
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
    public function delete(): void
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
    public function edit(int $id): void
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
