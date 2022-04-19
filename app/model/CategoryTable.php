<?php
require_once('../app/core/Database.php');

class CategoryTable
{

    /**
     * insert 
     * @param string name
     * @return bool
     */
    public function insert($name)
    {
        $db = Database::getInstance();
        $query = "INSERT INTO categories (name) VALUES (:name)";
        return $db->write($query, ['name'=>$name]);
    }
}
