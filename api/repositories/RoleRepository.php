<?php

require_once dirname(dirname(__DIR__)) .DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) .DIRECTORY_SEPARATOR .'models' . DIRECTORY_SEPARATOR . 'Role.php';

class RoleRepository
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    public function getRoleByName($role_name)
    {
        $sql = 'SELECT * FROM roles WHERE role_name = :role_name';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':role_name', $role_name);
        $stmt->execute();

        $roledata = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($roledata) {
            return new Role(
                $roledata['id'],
                $roledata['role_name'],
                $roledata['description']
            );
        } else {
            return null;
        }
    }

    public function findAllRole(){
        try{
            $sql = 'SELECT * FROM roles WHERE id';
            $stmt = $this->pdo->query($sql);
            $roles = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                $roles[] = $row;
              
            }
            return $roles;
        }catch(PDOException $e){
            echo 'PDOExecption:' .$e->getMessage();
            return[];
        }
    }
}
