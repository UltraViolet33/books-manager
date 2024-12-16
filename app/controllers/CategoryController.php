<?php

namespace App\controllers;

use App\core\Controller;
use App\models\Category;
use Valitron\Validator;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->model = new Category();
    }

    public function index(): void
    {
        $data['categories'] =  $this->model->getAll();
        $this->view('categories/index', $data);
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $v = new Validator($_POST);
            $v->rule('required', 'name');

            if ($v->validate()) {
                $name = $this->validateData($_POST['name']);
                if ($this->model->insert($name)) {
                    header("Location: " . ROOT . "category");
                    return;
                }
            }

            $_SESSION['error'] = $v->errors();
        }

        $this->view("categories/add");
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $v = new Validator($_POST);
            $v->rule('required', 'id');
            $v->rule('integer', 'id');

            if ($v->validate()) {
                $id = $_POST['id'];
                $this->model->deleteCategory($id);
                header("Location: " . ROOT . "category");
            }

            header("Location: " . ROOT . "category");
        }
    }

    public function edit(int $id): void
    {
        if (!is_numeric($id) || $id == 0) {
            header("Location: " . ROOT . "category");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $v = new Validator($_POST);
            $v->rule('required', 'name');

            if ($v->validate()) {
                $name = $this->validateData($_POST['name']);
                $this->model->updateCategory($id, $name);
                header("Location: " . ROOT . "category");
                return;
            }

            $_SESSION['error'] = $v->errors();
        }

        $category = $this->model->selectCategory($id);

        if (!$category) {
            header("Location: " . ROOT . "category");
        }

        $data['category'] = $category;
        $this->view("categories/edit", $data);
    }
}
