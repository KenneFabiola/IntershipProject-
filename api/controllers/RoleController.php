<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'RoleService.php';

class RoleController
{
    private $role_service;
   

    public function __construct()
    {
        $this->role_service = new RoleService();
      
    }
     
    public function getRoleName($role_name) {
            $roles = $this->role_service->findRoleName($role_name);
            if($roles) {
          
                return json_encode($roles);
            }else {
                echo json_encode(['error' => 'Role not found']);
            }
    }

    public function getAllRole() {
        $roles = $this->role_service->findAllRole();
        if ($roles) {
            echo '<pre>';
            print_r($roles);
           echo ' </pre>';
           return json_encode($roles);
          
        } else {
            echo json_encode(['error' => 'No roles found']);
        }
    }
}


$controller = new RoleController();

$json_role = $controller->getAllRole();
$roles = json_decode($json_role,true);

