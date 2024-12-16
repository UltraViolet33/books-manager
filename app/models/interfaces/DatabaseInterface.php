<?php

namespace App\models\interfaces;

interface DatabaseInterface
{

    public static function connect(): self;

    public function write(string $query, array $data = []): bool;

    public function read(string $query, array $data = []): array|bool;

    public function readOneRow(string $query, array $data = array()): object|bool;
}
