<?php

namespace App\core;

use App\core\Config;
use App\models\interfaces\DatabaseInterface;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{

  private ?PDO $PDOInstance = null;
  private static ?self $instance = null;

  public function __construct()
  {
    $string = Config::$dbType . ":host=" . Config::$dbHost . ";dbname=" . Config::$dbName;
    try {
      $this->PDOInstance  = new PDO($string, Config::$dbUser, Config::$dbPassword);
    } catch (PDOException $e) {
      echo "Une erreur est survenue";
      die;
    }
  }

  public static function connect(): self
  {
    if (is_null(self::$instance)) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public static function getInstance(): self
  {
    if (is_null(self::$instance)) {
      self::$instance = new Database();
    }
    return self::$instance;
  }


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
    return [];
  }

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

  public function write(string $query, array $data = array()): bool
  {
    $statement = $this->PDOInstance->prepare($query);
    return $statement->execute($data);
  }

  public function getLastInsertId(): int
  {
    return $this->PDOInstance->lastInsertId();
  }
}
