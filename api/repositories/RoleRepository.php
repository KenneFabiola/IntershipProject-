<?php
require_once('../../Database.php');
require_once('../models/Role.php');

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
}
