<?php

require_once('../app/core/controller.php');

class BookController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model  = $this->loadModel("Book");
    }

    /**
     * index
     * display category view
     */
    public function index()
    {
        $books = $this->model->getAll();
        $data['books'] = $books;
        extract($data);
        $this->view('index', $data);
    }

    /**
     * add
     * add a book in the BDD
     */
    public function add()
    {
        if (isset($_POST['addBook'])) {
            if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['category_id']) && is_numeric($_POST['category_id'])) {
                $title = validateData($_POST['title']);
                $author = validateData($_POST['author']);
                $id = validateData($_POST['category_id']);
                if ($this->model->insert($title, $author, $id)) {
                    header("Location: " . ROOT . "book");
                    return;
                }
            } else {
                $_SESSION['error'] = "All inputs must be filled <br>";
            }
        }

        $categoryTable = $this->loadModel('CategoryTable');
        $categories = $categoryTable->getAll();
        $data['categories'] = $categories;
        extract($data);
        $this->view("books/add", $data);
    }

    /**
     * delete
     * delete a book in the BDD
     */
    public function delete()
    {
        if (isset($_POST['deleteBook'])) {
            if (!empty($_POST['id'])) {

                $id = (int)$_POST['id'];
                if ($id === 0) {
                    header("Location: " . ROOT . "book");
                    return;
                } elseif (is_int($id) && $id !== 0) {
                    $this->model->deleteBook($id);
                    header("Location: " . ROOT . "book");
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
            header("Location: " . ROOT . "book");
            return;
        }

        if (isset($_POST['editBook'])) {
            if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['category_id']) && is_numeric($_POST['category_id'])) {
                $title = validateData($_POST['title']);
                $author = validateData($_POST['author']);
                $categoryId = validateData($_POST['category_id']);
                $this->model->updateBook($id, $title, $author, $categoryId);
                header("Location: " . ROOT . "book");
                return;
            } else {
                $_SESSION['error'] = "Name input must be filled <br>";
            }
        }
        $id = (int)$id;
        $book = $this->model->selectBook($id);
        $data['book'] = $book;

        $categoryTable = $this->loadModel('CategoryTable');
        $categories = $categoryTable->getAll();
        $data['categories'] = $categories;
        extract($data);
        $this->view("books/edit", $data);
    }
}
