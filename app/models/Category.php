<?php

namespace App\models;

use App\models\Table;
use App\core\Database;
use stdClass;

class Category extends Table
{

    protected string $table = "categories";
    protected string $id = "categories_id";


    /**
     * insert 
     * @param string name
     * @return bool
     */
    public function insert(string $name): bool
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
    public function getAll(): array
    {
        $db = Database::getInstance();
        return  $db->read("SELECT * FROM categories");
    }


    /**
     * delete a category in the BDD
     * @param int $id
     * @return void
     */
    public function deleteCategory(int $id): void
    {
        $this->delete($id);
    }


    /**
     * select one category in the BDD from its ID
     * @param int $id
     * @return stdClass
     */
    public function selectCategory($id): stdClass
    {
        return $this->selectOneItem($id);
    }


    /**
     * updateCategory
     * @param int $id
     * @param string $name
     * @return bool
     */
    public function updateCategory(int $id, string $name): bool
    {
        $query = "UPDATE categories SET name = :name WHERE $this->id = :id";
        $data = ["id" => $id, "name" => $name];
        return $this->db->write($query, $data);
    }
}
