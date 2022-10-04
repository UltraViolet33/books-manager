<?php

class Database
{

  private ?PDO $PDOInstance = null;
  private static ?self $instance = null;

  private function __construct()
  {
    $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
    $this->PDOInstance  = new PDO($string, DB_USER, DB_PASS);
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
  public function read($query, $data = array()): array|bool
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
