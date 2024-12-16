<?php

namespace App\models;

use App\models\Table;
use stdClass;

class Category extends Table
{

    protected string $table = "categories";
    protected string $id = "categories_id";

    public function insert(string $name): bool
    {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        return $this->db->write($query, ['name' => $name]);
    }

    public function getAll(): array
    {
        return $this->db->read("SELECT * FROM categories");
    }

    public function deleteCategory(int $id): void
    {
        $this->delete($id);
    }

    public function selectCategory(int $id): stdClass
    {
        return $this->selectOneItem($id);
    }

    public function updateCategory(int $id, string $name): bool
    {
        $query = "UPDATE categories SET name = :name WHERE $this->id = :id";
        $data = ["id" => $id, "name" => $name];
        return $this->db->write($query, $data);
    }
}
