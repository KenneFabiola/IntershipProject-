<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'RoleRepository.php';


class RoleService {
    private $role_repository;

    public function __construct() {
        $this->role_repository = new RoleRepository();
    }

    // public function createStudent($student) {
    //    $result = $this->role_repository->createStudent($student);
    //    if(isset($result['success'])) {
    //     return $result['success'];
    //    }elseif (isset($result['error'])) {
    //     return $result['error'];
    //    }
    // }

    // public function findById($id) {
    //     return $this->role_repository->findById($id);
    // }

    // public function updateStudent($student) {
    //     return $this->role_repository->updateStudent($student);
    // }

    // public function deleteStudent($id) {
    //     return $this->role_repository->deleteStudent($id);
    // }

    public function findAllRole() {
        return $this->role_repository->findAllRole();
    }

    public function findRoleName($role_name) {
        return $this->role_repository->getRoleByName($role_name);
    }

  
}