<?php

namespace App\models\interfaces;

interface DatabaseInterface
{    
    /**
     * connect
     *
     * @return void
     */
    public static function connect();

    
    /**
     * write
     *
     * @param  string $query
     * @param  array $data
     * @return bool
     */
    public function write(string $query, array $data = []): bool;

    
    /**
     * read
     *
     * @param  string $query
     * @param  array $data
     * @return array|bool
     */
    public function read(string $query, array $data = []): array|bool;
}
