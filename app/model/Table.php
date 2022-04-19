<?php

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
}
