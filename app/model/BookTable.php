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
    public function insert($title, $author)
    {
        $query = "INSERT INTO $this->table (title, author) VALUES (:title, :author)";
        $data['title'] = $title;
        $data['author'] = $author;
        return $this->db->write($query, $data);
    }

    /**
     * getAll
     * get al the categories from the BDD
     * @return array
     */
    // public function getAll()
    // {
    //     $db = Database::getInstance();
    //     return  $db->read("SELECT * FROM categories");
    // }

    /**
     * delete a category in the BDD
     * @param int $id
     */
    // public function deleteCategory($id)
    // {
    //     $this->delete($id);
    // }

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
