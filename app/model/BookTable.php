<?php

require_once('../app/core/Database.php');
require_once('../app/model/Table.php');

class BookTable extends Table
{

    protected $table = "books";
    protected $id = "books_id";

    /**
     * insert 
     * @param string name
     * @return bool
     */
    public function insert($title, $author, $categoryId)
    {
        $query = "INSERT INTO $this->table (title, author) VALUES (:title, :author)";
        $data['title'] = $title;
        $data['author'] = $author;
        $this->db->write($query, $data);
        $data = [];

        $idBook = $this->db->getLastInsertId();
        $queryCategory = "INSERT INTO books_categories (books_id, categories_id) VALUES(:books_id, :categories_id)";
        $data['books_id'] = $idBook;
        $data['categories_id'] = $categoryId;
        return $this->db->write($queryCategory, $data);
    }

    /**
     * getAll
     * get al the books from the BDD
     * @return array
     */
    public function getAll()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM books 
        JOIN books_categories 
        ON books.books_id = books_categories.books_id 
        JOIN categories 
        ON books_categories.categories_id = categories.categories_id";
        return  $db->read($query);
    }

    /**
     * delete a category in the BDD
     * @param int $id
     */
    public function deleteBook($id)
    {
        $this->delete($id);
    }

    /**
     * select one category in the BDD from its ID
     * @param int $id
     * @return array
     */
    // public function selectCategory($id)
    // {
    //     return $this->selectOneItem($id);
    // }

    /**
     * updateCategory
     * @param int $id
     * @param string $name
     */
    // public function updateCategory($id, $name)
    // {
    //     $query = "UPDATE categories SET name = :name WHERE $this->id = :id";
    //     $data['id'] = $id;
    //     $data['name'] = $name;
    //     $check =  $this->db->write($query, $data);
    // }
}
