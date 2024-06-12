<?php
class Database
{
   private $host = 'localhost';
   private $dbName = 'pstage';
   private $username = 'root';
   private $password = '';
   private $conn = null;

   /**
    * Create connection to the database and the connection object
    *
    * @return \PDO
    */
   public function connect()
   {
      $this->conn = null;
      try {
         $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName,  $this->username, $this->password);
         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         echo "connexion reuissie";
      } catch (PDOException $e) {
         echo 'Echec de la connection' . $e->getMessage();
      }
      return $this->conn;
   }
}
