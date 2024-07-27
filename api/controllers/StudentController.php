<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'StudentService.php';

class StudentController
{
    private $student_service;
    private $user_repository;

    public function __construct()
    {
        $this->student_service = new StudentService();
        $this->user_repository = new UserRepository(); // Pour les futures utilisations, si nécessaire
    }

    // verified the authentification of user


    // Méthode pour créer un étudiant
    public function createStudent()
    {

        if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
            echo json_encode(['error' => 'unauthorized']);
            exit();
        }

        if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) { {
                echo json_encode(['error' => 'unauthorized']);
                exit();
            }
        }
        if (isset($_POST['addStudent'])) {

            $created_by = $_SESSION['id'];
            $last_modified_by = $_SESSION['id'];

            // get data post
            $username = htmlspecialchars($_POST['username'] ?? null);
            $first_name = htmlspecialchars($_POST['first_name'] ?? null);
            $last_name = htmlspecialchars($_POST['last_name'] ?? null);
            $email = htmlspecialchars($_POST['email'] ?? null);



            // Création de l'objet User
            $student = new Student(
                null,
                $username,
                $first_name,
                $last_name,
                $email,
                $created_by,
                $last_modified_by,
                null,
                null,
                null,
                false
            );
                $created_student = $this->student_service->createStudent($student);
               
           if($created_student ===1 ) {
            $_SESSION['success'] = 'student created successfully';
            header('location:../../views/dashbord/student.php');

           }elseif($created_student ===3) {
            $_SESSION['error'] = 'this student already exist';
            header('location:../../views/dashbord/student.php');

           }else {
            $_SESSION['error'] = 'failed to created student';
            header('location:../../views/dashbord/student.php');

           }
    
        }
    }
    public function createAccount()
    {

        if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
            echo json_encode(['error' => 'unauthorized']);
            exit();
        }

        if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) { {
                echo json_encode(['error' => 'unauthorized']);
                exit();
            }
        }
        if (isset($_POST['studentAccount']) ) {

            $id = intval($_POST['studentId']);

 
            $username = htmlspecialchars($_POST['username'] ?? null);
            $first_name = htmlspecialchars($_POST['first_name'] ?? null);
            $last_name = htmlspecialchars($_POST['last_name'] ?? null);
            $email = htmlspecialchars($_POST['email'] ?? null);
            $pwd = htmlspecialchars($_POST['email'] ?? null);
            $role_id = htmlspecialchars($_POST['role_id'] ?? null);

            // Création de l'objet User
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
                $created_user = $this->student_service->createAccount($id,$user);
               if($created_user == 1) {
                $_SESSION['success'] = 'compte utilisateur créé, le mot de passe de cet utilisateur est son adresse email';
               } elseif($created_user == 12) {
                $_SESSION['error'] = 'Un compte utilisateur est déjà défini pour cet étudiant';
               } else {
                $_SESSION['error'] =  'undefined error';
               }
    
        }
    }

    
public function disableAccount() {
    if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
        echo json_encode(['error' => 'unauthorized']);
        exit();
    }

    if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) { {
            echo json_encode(['error' => 'unauthorized']);
            exit();
        }
    }

    if(isset($_POST['disableAccount'])) {
        $id = intval($_POST['studentIdDisable']);
        $disable = $this->student_service->disableAccount($id);
        if($disable == 1) {
           $_SESSION ['success'] = 'compte desactivé';
        } else {
            $_SESSION ['success'] = 'error';
        }


    }

}
    // update student
    public function updateStudent()
    {
        if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
            echo json_encode(['error' => 'unauthorized']);
            exit();
        }

        if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) { {
                echo json_encode(['error' => 'unauthorized']);
                exit();
            }
        }

        if(isset($_POST['updateStudent'])) {     
                           // get data post                
                $id = intval($_POST['updateStudentById']);
                $last_modified_by = $_POST['last_modified_by'];
                $username = htmlspecialchars($_POST['username'] ?? null);
                $first_name = htmlspecialchars($_POST['first_name'] ?? null);
                $last_name = htmlspecialchars($_POST['last_name'] ?? null); 
                $email = htmlspecialchars($_POST['email'] ?? null);

                $student = $this->student_service->findById($id);
                
                if($student) {
                    $student->setUsername($username ?? $student->getUsername());
                    $student->setFirstName($first_name ?? $student->getFirstName());
                    $student->setLastName($last_name ?? $student->getLastName());
                    $student->setEmail($email ?? $student->getEmail());
                    $student->setLastModifiedBy($last_modified_by ?? $student->getLastModifiedBy());
                    
                    $update_student= $this->student_service->updateStudent($student);

                         
           if($update_student ===1 ) {
            $_SESSION['success'] = 'student updated successfully';
            header('location:../../views/dashbord/student.php');

           }elseif($update_student ===3) {
            $_SESSION['error'] = 'this student already exist';
            header('location:../../views/dashbord/student.php');

           }else {
            $_SESSION['error'] = 'failed to update student';
            header('location:../../views/dashbord/student.php');

           }

                } else {
                    $_SESSION['error'] = 'failed to update student';

                }


           
           
           
        }
    }

    // delete student
    public function deleteStudent()
    {

      if(isset($_POST['deleteStudent'])) {
        $id = intval($_POST['deleteStudentById']);
        var_dump($id);

        $deleted = $this->student_service->deleteStudent($id);
        if($deleted) {
            echo json_encode(['success' => 'User deleted']);
                header('location:../../views/dashbord/student.php');
        }else {
            echo json_encode(['error' => 'Failed to delete user']);
        }
      }else {
        echo json_encode(['error' => 'Student ID not provided']);
    }
    }

    // Méthode pour récupérer un étudiant par ID
    public function getStudentById($id)
    {
        $student = $this->student_service->findById($id);
        if ($student) {
            echo json_encode($student);
        } else {
            echo json_encode(['error' => 'Student not found']);
        }
    }

    // Get all student
    public function getAllStudents()
    {
        $students = $this->student_service->findAll();
        if ($students) {
           
            return json_encode($students);
        } else {
            // return json_encode(['error' => 'No students found']);
        }
    }
    public function getAllRegisterStudent()
    {
        $register_student = $this->student_service->findAllRegisterStudent();
        if ($register_student) {
            return json_encode($register_student);
        } else {
            // return json_encode(['error' => 'No students found']);
        }
    }
    public function getAllUnregisterStudent()
    {
        $unregister_student = $this->student_service->findAllUnregisterStudent();
        if ($unregister_student) {
            return json_encode($unregister_student);
        } else {
            // return json_encode(['error' => 'No students found']);
        }
    }
}

// Connexion à la base de données et création de l'instance du contrôleur
// $database = new Database();
// $pdo = $database->connect();
$controller = new StudentController();

$json_student = $controller->getAllStudents();
$students = json_decode($json_student,true);

$json_register_student = $controller->getAllRegisterStudent();
$register_student = json_decode($json_register_student,true);

$json_unregister_student = $controller->getAllUnregisterStudent();
$unregister_student = json_decode($json_unregister_student,true);

if(isset($_POST['addStudent'])) {
    $controller->createStudent();
}
if(isset($_POST['deleteStudent'])) {
    $controller->deleteStudent();
}
if(isset($_POST['updateStudent'])) {
    $controller->updateStudent();
}

if (isset($_POST['studentAccount'])) {
    $controller->createAccount();
}
if( isset($_POST['disableAccount'])) {
    $controller->disableAccount();

}

