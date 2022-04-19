<?php

require_once('../app/core/controller.php');

class Book extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model  = $this->loadModel("BookTable");
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
                    header("Location: " . ROOT . "home");
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
     * delete a category in the BDD
     */
    // public function delete()
    // {
    //     if (isset($_POST['deleteCat'])) {
    //         if (!empty($_POST['id'])) {
    //             $id = (int)$_POST['id'];
    //             if ($id === 0) {
    //                 header("Location: " . ROOT . "category");
    //                 return;
    //             } elseif (is_int($id) && $id !== 0) {
    //                 $this->model->deleteCategory($id);
    //                 header("Location: " . ROOT . "category");
    //                 return;
    //             }
    //         }
    //     }
    // }

    /**
     * edit
     * edit a category in the BDD
     * @param int $id
     */
    // public function edit($id)
    // {
    //     if (!is_numeric($id) || $id == 0) {
    //         header("Location: " . ROOT . "category");
    //         return;
    //     }

    //     if (isset($_POST['editCat'])) {
    //         if (!empty($_POST['name'])) {
    //             $name = validateData($_POST['name']);
    //             $this->model->updateCategory($id, $name);
    //             header("Location: " . ROOT . "category");
    //             return;
    //         } else {
    //             $_SESSION['error'] = "Name input must be filled <br>";
    //         }
    //     }
    //     $id = (int)$id;
    //     $category = $this->model->selectCategory($id);
    //     $data['category'] = $category;
    //     extract($data);
    //     $this->view("categories/edit", $data);
    // }
}
