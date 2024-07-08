<?php
// require_once("../repositories/UserRepository.php");
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';

class UserService {
    private $user_repository;

    public function __construct($pdo) {
        $this->user_repository = new UserRepository($pdo);
    }

    public function createUser($user) {
        $result = $this->user_repository->createUser($user);
        if (isset($result['success'])) {
            return $result['success'];
        } elseif (isset($result['error'])) {
            return ['error' => $result['error']];
        }
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
        return $this->user_repository->findAll();
    }

    public function findByUsername($username) {
        return  $this->user_repository->findByUsername($username);

    
    }
    public function findUsernameUser($id) {
        return $this->user_repository->findUsernameUserById($id);
    }



    
}