<?php

namespace App\models;

use App\models\Table;
use stdClass;

class Book extends Table
{

    protected string $table = "books";
    protected string $id = "books_id";


    /**
     * insert 
     * @param string name
     * @return bool
     */
    public function insert(array $data): bool
    {
        $query = "INSERT INTO $this->table (title, author, status, books_cat_id) VALUES (:title, :author, :status, :category_id)";
        return $this->db->write($query, $data);
    }


    /**
     * getAll
     * get al the books from the BDD
     * @return array
     */
    public function getAll(): array
    {
        $query = "SELECT * FROM books 
        JOIN categories 
        ON books.books_cat_id = categories.categories_id";
        return  $this->db->read($query);
    }


    /**
     * delete a category in the BDD
     * @param int $id
     * @return void
     */
    public function deleteBook(int $id): void
    {
        $this->delete($id);
    }


    /**
     * select one category in the BDD from its ID
     * @param int $id
     * @return stdClass
     */
    public function selectBook(int $id): stdClass
    {
        $query = "SELECT * FROM books JOIN categories ON books.books_cat_id = categories.categories_id WHERE $this->id = :id";
        return $this->db->readOneRow($query, ['id' => $id]);
    }
    

    /**
     * updateCategory
     * @param int $id
     * @param string $name
     * @return bool
     */
    public function updateBook($data): bool
    {
        $query = "UPDATE books SET title = :title, author = :author, status = :status, books_cat_id = :category_id WHERE $this->id = :id";
        return $this->db->write($query, $data);
    }
}
