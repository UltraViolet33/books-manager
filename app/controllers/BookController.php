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


    /**
     * index
     * display category view
     * @return void
     */
    public function index(): void
    {
        $books = $this->model->getAll();
        $data['books'] = $books;
        $this->view('index', $data);
    }


    /**
     * add
     * add a book in the BDD
     * @return void
     */
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

        $categoryTable = new Category();
        $categories = $categoryTable->getAll();
        $data['categories'] = $categories;
        $this->view("books/add", $data);
    }


    /**
     * delete
     * delete a book in the BDD
     * @return void
     */
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



    /**
     * edit
     * edit a category in the BDD
     * @param int $id
     * @return void
     */
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

        $book = $this->model->selectBook($id);
        $data['book'] = $book;
        $categoryTable = new Category();
        $categories = $categoryTable->getAll();
        $data['categories'] = $categories;
        $this->view("books/edit", $data);
    }


    /**
     * validateBookData
     *
     * @param  array $data
     * @return bool
     */
    private function validateBookData(array $data): bool
    {
        $this->v = new Validator($data);
        $this->v->rule("required", ["title", "author", "category_id"]);
        $this->v->rule("integer", "category_id");

        return $this->v->validate();;
    }


    /**
     * cleanDataForm
     *
     * @param  array $data
     * @return array
     */
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
