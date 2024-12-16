<?php

namespace App\controllers;

use App\core\Controller;
use App\models\Book;
use App\models\Category;
use Valitron\Validator;


class BookController extends Controller
{
    private Validator $v;

    public function __construct()
    {
        $this->model = new Book();
    }

    public function index(): void
    {
        $data['books'] = $this->model->getAll();
        $this->view('index', $data);
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($this->validateBookData($_POST)) {
                $data = $this->cleanDataForm($_POST);
                $this->model->insert($data);
                header("Location: " . ROOT . "book");
                return;
            }

            $_SESSION["error"] = $this->v->errors();
        }

        $data['categories'] = (new Category())->getAll();
        $this->view("books/add", $data);
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $v = new Validator($_POST);
            $v->rule('required', "id");
            $v->rule("integer", "id");

            if ($v->validate()) {
                $id = $_POST['id'];
                $this->model->deleteBook($id);
                header("Location: " . ROOT . "book");
                return;
            }

            $_SESSION['error'] = $v->errors();
        }
    }

    public function edit(int $id): void
    {
        if (!is_numeric($id) || $id == 0) {
            header("Location: " . ROOT . "book");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($this->validateBookData($_POST)) {

                $data = $this->cleanDataForm($_POST);
                $data['id'] = $id;

                $this->model->updateBook($data);
                header("Location: " . ROOT . "book");
                return;
            }

            $_SESSION["error"] = $this->v->errors();
        }


        $data['book'] = $this->model->selectBook($id);
        $data['categories'] = (new Category())->getAll();
        $this->view("books/edit", $data);
    }

    private function validateBookData(array $data): bool
    {
        $this->v = new Validator($data);
        $this->v->rule("required", ["title", "author", "category_id"]);
        $this->v->rule("integer", "category_id");

        return $this->v->validate();;
    }

    private function cleanDataForm(array $data): array
    {
        $cleanData = [];
        $cleanData["status"] = 0;

        if (isset($data['status'])) {
            $cleanData['status'] = 1;
        }

        foreach ($data as $name => $item) {
            $cleanData[$name] = $this->validateData($item);
        }

        return $cleanData;
    }
}
