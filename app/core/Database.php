<?php

namespace App\core;

use App\core\Config;
use App\models\interfaces\DatabaseInterface;
use PDO;

class Database implements DatabaseInterface
{

  private ?PDO $PDOInstance = null;
  private static ?self $instance = null;

  public function __construct()
  {
    $string = Config::$dbType . ":host=" . Config::$dbHost . ";dbname=" . Config::$dbName;
    $this->PDOInstance  = new PDO($string, Config::$dbUser, Config::$dbPassword);
  }


  public static function connect(): self
  {
    if (is_null(self::$instance)) {
      self::$instance = new Database();
    }
    return self::$instance;
  }


  /**
   * return Database instance 
   * @return self $instance
   */
  public static function getInstance(): self
  {
    if (is_null(self::$instance)) {
      self::$instance = new Database();
    }
    return self::$instance;
  }


  /**
   * read
   * read on the BDD
   * @param string $query
   * @param array $data
   * @return array|bool
   */
  public function read(string $query, array $data = array()): array|bool
  {
    $statement = $this->PDOInstance->prepare($query);
    $result = $statement->execute($data);

    if ($result) {
      $data = $statement->fetchAll(PDO::FETCH_OBJ);
      if (is_array($data) && count($data) > 0) {
        return $data;
      }
    }
    return false;
  }


  /**
   * readOneRow
   * read one row on the DB
   * @param  string $query
   * @param  array $data
   * @return object|bool
   */
  public function readOneRow(string $query, array $data = array()): object|bool
  {
    $statement = $this->PDOInstance->prepare($query);
    $result = $statement->execute($data);

    if ($result) {
      $data = $statement->fetch(PDO::FETCH_OBJ);
      if (is_object($data)) {
        return $data;
      }
    }
    return false;
  }


  /**
   * write
   * write on the BDD
   * @param string $query
   * @param array $data
   * @return bool
   */
  public function write(string $query, array $data = array()): bool
  {
    $statement = $this->PDOInstance->prepare($query);
    return $statement->execute($data);
  }


  /**
   * getLastInsertId
   * return the last id inserted
   * @return int
   */
  public function getLastInsertId(): int
  {
    return $this->PDOInstance->lastInsertId();
  }
}
