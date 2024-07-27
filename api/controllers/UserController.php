<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'RoleRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'services' . DIRECTORY_SEPARATOR . 'UserService.php';
// require_once dirname(__DIR__) . DIRECTORY_SEPARATOR .'services' . DIRECTORY_SEPARATOR . 'AuthentificateService.php';

class UserController {
    private $user_service;
    // private $authentificate_service;
    private $role_repository;

    public function __construct() {
        $this->role_repository = new RoleRepository();
        $this->user_service = new UserService();
        // $this->authentificate_service = new AuthentificateService();
    }
/**
 * created user
 * 
 *
 * @return void
 */
public function createUser() {
    if ((isset($_POST['submit'])) || (isset($_POST['signUp']))) {
        $role_id = null;
    if ((isset($_POST['role_id'])) && !empty($_POST['role_id'])) {
        $role_id = $_POST['role_id']; 

        } else {
        $role_id = 3; echo $role_id;
        }

        // $role_id = $_POST['role_id'] ??  3; 
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
            null,
            $role_id

        );

       print_r($user); 

        //call services to verify
      
 
            $createdUser = $this->user_service->createUser($user);
           
       
        // check an error while user is create
        if ($createdUser === 1) {
            $_SESSION['success'] = "user created successfully";
            header('location:../../views/dashbord/dashbord.php');

        } elseif($createdUser === 3) {
            $_SESSION['error'] = "cet adresse email et ou ce nom d'utilisateur existe déjà";
            header('location:../../views/dashbord/dashbord.php');
            


            // echo json_encode(['success' => 'User created successfully']);         

        } else {
            $_SESSION['error'] == "unknown the type an error , please try again";
            header('location:../../views/dashbord/dashbord.php');

        }
    }
}


    /**
     * update user
     */

    public function updateUser()
    {
        if (isset($_POST['update'])) {
            $id = intval($_POST['updateById']);
            $role_id = $_POST['role_id'] ?? null;
            $username = htmlspecialchars($_POST['username']);
            $first_name = htmlspecialchars($_POST['first_name']);
            $last_name = htmlspecialchars($_POST['last_name']);
            $email = htmlspecialchars($_POST['email']);

            $user = $this->user_service->findById($id);

            if ($user) {
                $user->setUsername($username ?? $user->getUsername());
                $user->setFirstName($first_name ?? $user->getFirstName());
                $user->setLastName($last_name ?? $user->getLastName());
                $user->setEmail($email ?? $user->getEmail());
                $user->setRoleId($role_id ?? $user->getRoleId());

                $updatedUser = $this->user_service->updateUser($user);
                if ($updatedUser === 1) {
                    $_SESSION['success'] = 'User updated successfully';
                    header('location:../../views/dashbord/dashbord.php');

                } elseif($updatedUser === 3) {
                    $_SESSION['error'] = "cet adresse email et ou ce nom d'utilisateur existe déjà";
                    header('location:../../views/dashbord/dashbord.php');
                }else {
                    $_SESSION['error'] == "unknown the type an error , please try again";
                    header('location:../../views/dashbord/dashbord.php');
        
                }
            } else {
                $_SESSION['error'] == "id not provided";

            }
        }
    }

/**
 * update user
 */

    public function deleteUser() {
        
        if(isset($_POST['delete'])) {

            

            $id= intval($_POST['deleteById']);
            $role_id = $_POST['role_id'];

            if($role_id == 1) {
                $_SESSION['error']=  'vous ne pouvez pas supprimé un administrateur';
                header('location:../../views/dashbord/dashbord.php');

                exit();
            } 
      
            $deleted = $this->user_service->deleteUser($id);
            
            if ($deleted) {
                $_SESSION['success'] = 'user deleted';
                header('location:../../views/dashbord/dashbord.php');
            } else {
                $_SESSION['error'] = 'failed to delete use';
                
            }
         }
         else {
            echo json_encode(['error' => 'User ID not provided']);
        }

    }
    
    public function getAllUsers() {

        $user = $this->user_service->findAll();
        if ($user) {

           return json_encode($user);
          
        } else {
            echo json_encode(['error' => 'No users found']);
        }
    }
    public function getAllUserAdmin() {
        $user_admin = $this->user_service->findAllAdmin();
        if ($user_admin) {

           return json_encode($user_admin);
          
        } else {
            echo json_encode(['error' => 'No users found']);
        }
    }
    public function getAllUserSecretary() {
        $user_secretary = $this->user_service->findAllSecretary();
        if ($user_secretary) {
        //    echo '<pre>';
        //    print_r($user_secretary);
        //    echo '</pre>';
           return json_encode($user_secretary);
          
        } else {
            echo json_encode(['error' => 'No users found']);
        }
    }
    public function getAllUserStudent() {
        $user_student = $this->user_service->findAllStudent();
        if ($user_student) {
        //    echo '<pre>';
        //    print_r($user_student);
        //    echo '</pre>';
           return json_encode($user_student);
          
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
$json_user_admin = $controller->getAllUserAdmin();
$json_user_secretary = $controller->getAllUserSecretary();
$json_user_student = $controller->getAllUserStudent();

 
 $users = json_decode($json_user,true);
 $users_admin = json_decode($json_user_admin,true);
 $users_secretary = json_decode($json_user_secretary,true);
 $users_student = json_decode($json_user_student,true);


if ((isset($_POST['submit'])) || (isset($_POST['signUp']) )) {
    $controller->createUser();
}
if(isset($_POST['delete'])) {
    $controller->deleteUser();
}
if(isset($_POST['update'])) {
    $controller->updateUser();
}


