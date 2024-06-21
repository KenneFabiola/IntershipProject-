<?php
session_start();
require_once("../../Database.php");
require_once("../repositories/UserRepository.php");
require_once("../repositories/RoleRepository.php");
require_once("../services/UserService.php");

class UserController {
    private $user_service;
    private $role_repository;

    public function __construct($pdo) {
        $this->role_repository = new RoleRepository($pdo);
        $this->user_service = new UserService($pdo);
    }
/**
 * created user
 *
 * @return void
 */
public function createUser() {
    $role_name = 'student';
    $role = $this->role_repository->getRoleByName($role_name);
    if ($role) {
        $role_id = $role->getId();

        // get data post
        $username = $_POST['username'] ?? null;
        $first_name = $_POST['first_name'] ?? null;
        $last_name = $_POST['last_name'] ?? null;
        $email = $_POST['email'] ?? null;
        $pwd = $_POST['pwd'] ?? null;

        // Validation des données si nécessaire
        // ...

        // Création de l'objet User
        $user = new User(
            null,
            $username,
            $first_name,
            $last_name,
            $email,
            $pwd,
            false, 
            $role_id
        );

        // get service for authentification
        $createdUser = $this->user_service->createUser($user);

        if ($createdUser) {
            echo json_encode(['success' => 'User created successfully']);
        } else {
            echo json_encode(['error' => 'Failed to create user']);
        }
    } else {
        echo json_encode(['error' => 'Role not found']);
    }
}

    /**
     * update user
     */

    public function updateUser() {
        $role_name = 'student';
        $role = $this->role_repository->getRoleByName($role_name);
        if ($role) {
            $role_id = $role->getId();
            $input_data = json_decode(file_get_contents("php://input"), true);

            $id = $input_data['id'] ?? null;
            $user = $this->user_service->findById($id);
            if ($user) {
                $user->setUsername($input_data['username'] ?? $user->getUsername());
                $user->setFirstName($input_data['first_name'] ?? $user->getFirstName());
                $user->setLastName($input_data['last_name'] ?? $user->getLastName());
                $user->setEmail($input_data['email'] ?? $user->getEmail());
                $user->setPwd($input_data['pwd'] ?? $user->getPwd());
                $user->setRoleId($role_id);

                $updatedUser = $this->user_service->updateUser($user);
                if ($updatedUser) {
                    echo json_encode(['success' => 'User updated successfully']);
                } else {
                    echo json_encode(['error' => 'Failed to update user']);
                }
            } else {
                echo json_encode(['error' => 'User not found']);
            }
        } else {
            echo json_encode(['error' => 'Role not found']);
        }
    }

/**
 * update user
 */

    public function deleteUser() {
        $input_data = json_decode(file_get_contents("php://input"), true);
        $id = $input_data['id'] ?? null;
        if ($id) {
            $deleted = $this->user_service->deleteUser($id);
            if ($deleted) {
                echo json_encode(['success' => 'User deleted']);
            } else {
                echo json_encode(['error' => 'Failed to delete user']);
            }
        } else {
            echo json_encode(['error' => 'User ID not provided']);
        }
    }
/**
 * get user by their id
 *
 * @param id $id
 * @return void
 */
    public function getUserById($id) {
        $user = $this->user_service->findById($id);
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
    }

    public function getAllUsers() {
        $users = $this->user_service->findAll();
        if ($users) {
            echo json_encode($users);
        } else {
            echo json_encode(['error' => 'No users found']);
        }
    }


    /**
     * connection of user
     */
    public function authentificate() {
        $input_data = json_decode(file_get_contents("php://input"). true);

        $username = $input_data['username'] ?? null;
        $pwd = $input_data['pwd'] ?? null;

        if(!$username || !$pwd ) {
            echo json_encode(['error' =>'username and password are required']);
            return;
        }
        $user = $this->user_service->authentificate($username,$pwd);
        if($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo json_encode(['sucess' =>'user authentificated succefully']);

        }else{
            echo json_encode(['error' =>'failed to authenticated user']);

        }   
    }
}

$database = new Database();
$pdo = $database->connect();
$controller = new UserController($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createUser();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller->updateUser();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller->deleteUser();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $controller->getUserById($_GET['id']);
    } else {
        $controller->getAllUsers();
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}