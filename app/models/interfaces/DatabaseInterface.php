<?php

namespace App\models\interfaces;

interface DatabaseInterface
{
    public static function connect();

    public function write(string $query, array $data = []): bool;

    public function read(string $query, array $data = []): array|bool;
}
