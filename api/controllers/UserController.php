<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'RoleRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'services' . DIRECTORY_SEPARATOR . 'UserService.php';

class UserController {
    private $user_service;
    private $role_repository;

    public function __construct() {
        $this->role_repository = new RoleRepository();
        $this->user_service = new UserService();
    }
/**
 * created user
 * 
 *
 * @return void
 */
public function createUser() {
    if ((isset($_POST['submit'])) || (isset($_POST['signUp']))) {
        $role_id = $_POST['role_id'] ?? 3;
        $username = htmlspecialchars($_POST['username']); 
        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars($_POST['email']);
        $pwd = htmlspecialchars($_POST['pwd'] ?? 'azerty');

        // create user object
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
       

        //call services to verify
      
        try {
            $createdUser = $this->user_service->createUser($user);
           
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error creating user: ' . $e->getMessage()]);
            return;
        }

        // check an error while user is create
        if (is_array($createdUser) && isset($createdUser['error'])) {
            echo json_encode(['error' => $createdUser['error']]);
        } else {
            echo json_encode(['success' => 'User created successfully']);
            

        }
    }
}


    /**
     * update user
     */

    public function updateUser() {
        if(isset($_POST['update'])) {
            $role_name = $_POST['role'] ?? 'student';
            $role = $this->role_repository->getRoleByName($role_name);
    
             if ($role) {
                $role_id = $role->getId();
                $id = intval($_POST['updateById']);

                $username = htmlspecialchars($_POST['username']);
                $first_name = htmlspecialchars($_POST['first_name']);
                $last_name = htmlspecialchars($_POST['last_name']);
                $email = htmlspecialchars($_POST['email']);
                // $pwd = htmlspecialchars($_POST['pwd']);
                $deleted = false;
                $user = $this->user_service->findById($id);

            if ($user) {
                $user->setUsername($username?? $user->getUsername());
                $user->setFirstName($first_name ?? $user->getFirstName());
                $user->setLastName($last_name ?? $user->getLastName());
                $user->setEmail($email ?? $user->getEmail());
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
    }

/**
 * update user
 */

    public function deleteUser() {
        
        if(isset($_POST['delete'])) {

            $id= intval($_POST['deleteById']);
           var_dump($id); 
           
            $deleted = $this->user_service->deleteUser($id);
            
            if ($deleted) {
                echo json_encode(['success' => 'User deleted']);
                header('location:../../views/dashbord/dashbord.php');
            } else {
                echo json_encode(['error' => 'Failed to delete user']);
            }
         }
         else {
            echo json_encode(['error' => 'User ID not provided']);
        }

    }
    
    public function getAllUsers() {
        $user = $this->user_service->findAll();
        if ($user) {
        //    echo '<pre>';
        //    print_r($user);
        //    echo '</pre>';
           return json_encode($user);
          
        } else {
            echo json_encode(['error' => 'No users found']);
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

 


    /**
     * connection of user
     */

}


// $database = new Database();
// $pdo = $database->connect();
$controller = new UserController();

$json_user = $controller->getAllUsers();

 
 $users = json_decode($json_user,true);


if ((isset($_POST['submit'])) || (isset($_POST['signUp']) )) {
    $controller->createUser();
}
if(isset($_POST['delete'])) {
    $controller->deleteUser();
}
if(isset($_POST['update'])) {
    $controller->updateUser();
}


