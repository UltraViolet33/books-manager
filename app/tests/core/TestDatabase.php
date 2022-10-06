<?php

use PHPUnit\Framework\TestCase;
use App\core\Database;

use App\tests\TestsUtils;

class TestDatabase extends TestCase
{
    use TestsUtils;

    public function testGetInstance()
    {
        $db = new Database();
        $instance = Database::getInstance();
        $this->assertEquals($db, $instance);
    }

    public function testGetLastInsertId()
    {
        $db = Database::getInstance();
        $id = $db->getLastInsertId();
        $this->assertIsInt($id);
    }
}
