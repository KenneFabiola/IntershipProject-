<?php

require_once('../api/repositories/UserRepository.php');
require_once('../api/models/User.php');



























































































































// $userRepository = new UserRepository($pdo);
// $userController = new UserController();

// try {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         echo $userController->createUser($_POST['first_names'], $_POST['last_name'], $_POST['email'], $_POST['pwd']);
//     } else {
//         echo json_encode(['error' => 'Invalid request method']);
//     }
// } catch (Exception $e) {
//     echo json_encode(['error' => $e->getMessage()]);
// }

































// class Usercontroller{
//     private $userRepository;

//     public function __construct(){
//         $this->userRepository = new UserRepository();
//     }
//     public function createUser($id, $names, $email,$passwords,$role, $lastname){

//         $user= new User(null,$id, $names, $email,$pwd,$role, $lastname);

//         return json_encode($this->userRepository->createUser($user));
//     }
//  }