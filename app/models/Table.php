<?php


namespace App\models;

use App\core\Database;

class Table
{

    protected $table;
    protected $id;
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * delete
     * delete a item in the BDD
     * @param int $id
     */
    protected function delete($id)
    {
        $this->db->write("DELETE FROM $this->table WHERE $this->id  = $id");
    }

    /**
     * select one item in the BDD from its ID
     * @param int $id
     * @return array
     */
    protected function selectOneItem($id)
    {
        $query = "SELECT * FROM $this->table WHERE $this->id = :id";
        $item = $this->db->read($query, ['id' => $id]);
        return $item[0];
    }
}
