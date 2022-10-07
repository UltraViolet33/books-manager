<?php

namespace App\models;

use App\core\Database;
use App\models\interfaces\DatabaseInterface;
use stdClass;

class Table
{
    protected string $table;
    protected string $id;
    protected DatabaseInterface $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }


    /**
     * delete
     * delete a item in the BDD
     * @param int $id
     * @return void
     */
    protected function delete(int $id): void
    {
        $this->db->write("DELETE FROM $this->table WHERE $this->id  = $id");
    }


    /**
     * select one item in the BDD from its ID
     * @param int $id
     * @return stdClass
     */
    protected function selectOneItem(int $id): stdClass
    {
        $query = "SELECT * FROM $this->table WHERE $this->id = :id";
        return $this->db->readOneRow($query, ['id' => $id]);
    }
}
