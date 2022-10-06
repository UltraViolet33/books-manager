<?php

namespace App\models;

use App\models\Table;
use App\core\Database;

class Category extends Table
{

    protected $table = "categories";
    protected $id = "categories_id";

    /**
     * insert 
     * @param string name
     * @return bool
     */
    public function insert($name)
    {
        $db = Database::getInstance();
        $query = "INSERT INTO categories (name) VALUES (:name)";
        return $db->write($query, ['name' => $name]);
    }

    /**
     * getAll
     * get al the categories from the BDD
     * @return array
     */
    public function getAll()
    {
        $db = Database::getInstance();
        return  $db->read("SELECT * FROM categories");
    }

    /**
     * delete a category in the BDD
     * @param int $id
     */
    public function deleteCategory($id)
    {
        $this->delete($id);
    }

    /**
     * select one category in the BDD from its ID
     * @param int $id
     * @return array
     */
    public function selectCategory($id)
    {
        return $this->selectOneItem($id);
    }

    /**
     * updateCategory
     * @param int $id
     * @param string $name
     */
    public function updateCategory($id, $name)
    {
        $query = "UPDATE categories SET name = :name WHERE $this->id = :id";
        $data['id'] = $id;
        $data['name'] = $name;
        return $this->db->write($query, $data);
    }
}
