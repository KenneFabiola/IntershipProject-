<?php
require_once("../../Database.php");
require_once("../repositories/UserRepository.php");
require_once("../repositories/RoleRepository.php");
// objet of pdo for find the pdo connect

 $database = new Database;
 $pdo = $database->connect();

$roleRepository = new RoleRepository($pdo);
$userRepository = new UserRepository($pdo);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $role_name = 'student';

        $role = $roleRepository->getRoleByName($role_name);

        if($role) {
            $role_id = $role->getId();
        
            $user = new User(
                null,
                $_POST['username'],  
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email'],
                $_POST['pwd'],  
                $role_id
            );
//add user in the db
            $createUser = $userRepository->createUser($user);
            if($createUser){
                echo json_encode(['success' => 'user created successfully']);
            }
        } else {
            echo json_encode(['error' => 'Role not found']);
        }
    } elseif($_SERVER['REQUEST_METHOD'] === 'PUT') {
        
        $role_name = 'student';
        $role = $roleRepository->getRoleByName($role_name);
        if($role){
            // take id role by name 
            $role_id = $role->getId();
            $input_data= json_decode(file_get_contents("php://input", true));
            $id = $input_data->id ?? null;
            $username = $input_data->username ?? null;
            $first_name = $input_data->first_name ?? null;
            $last_name = $input_data->last_name ?? null;
            $email = $input_data->email ?? null;
            $pwd = $input_data->pwd ?? null;

            var_dump($input_data);

            $user = $userRepository->findById($id);
            // take user by their id
            if($user){
                $user->setUsername($username);
                $user->setFirstName($first_name);
                $user->setLastName($last_name);
                $user->setEmail($email);
                $user->setPwd($pwd);
                $user->setRoleId($role_id);

                // update user in the database 
                $updateUser = $userRepository->updateUser($user);
                if($updateUser){
                    echo json_encode(['success'=>'user update succefully']);
                }else{
                    echo json_encode(['error'=>'failed to update']);
                }
                
            }else{
                echo json_encode(['error'=>'user not found']);
            }
        }else{
            echo json_encode(['error'=>'role not found']);

        }

    }else{
        echo json_encode(['error'=>'invalid request method']);
    }
}catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
