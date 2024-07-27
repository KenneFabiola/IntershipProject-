<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';

class UserService {
    private $user_repository;

    public function __construct() {
        $this->user_repository = new UserRepository();
    }

    public function createUser($user) {
        return  $this->user_repository->createUser($user);
        // if (isset($result['success'])) {
        //     return $result['success'];
        // } elseif (isset($result['error'])) {
        //     return ['error' => $result['error']];
        // }
    }

    public function findById($id) {
        return $this->user_repository->findById($id);
    }

    public function updateUser($user) {
        return $this->user_repository->updateUser($user);
    }

    public function deleteUser($id) {
        return $this->user_repository->deleteUser($id);
    }

    public function findAll() {
        return $this->user_repository->findAllUser();
    }
    public function findAllAdmin() {
        return $this->user_repository->findAllUserAdmin();
    }
    public function findAllSecretary() {
        return $this->user_repository->findAllUserSecretary();
    }
    public function findAllStudent() {
        return $this->user_repository->findAllUserStudent();
    }

    public function findByUsername($username) {
        return  $this->user_repository->findByUsername($username);

    
    }
    public function findUsernameUser($id) {
        return $this->user_repository->findUsernameUserById($id);
    }



    
}