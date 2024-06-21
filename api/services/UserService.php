<?php
require_once("../repositories/UserRepository.php");

class UserService {
    private $user_repository;

    public function __construct($pdo) {
        $this->user_repository = new UserRepository($pdo);
    }

    public function createUser($user) {
        return $this->user_repository->createUser($user);
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

    public function authentificate($username, $pwd) {
        $user = $this->user_repository->findByUsername($username);

        if($user && password_verify($pwd,$user['pwd'])) {
            return $user;
        }
        return null;
    }
}