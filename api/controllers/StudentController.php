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
            $pwd = htmlspecialchars($_POST['pwd'] ?? 'azerty');


            // Création de l'objet User
            $student = new Student(
                null,
                $username,
                $first_name,
                $last_name,
                $email,
                $pwd,
                $created_by,
                $last_modified_by,
                null,
                false
            );
            try {
                $created_student = $this->student_service->createStudent($student);
               
            } catch (Exception $e) {
                echo json_encode(['error' => 'Error creating user: ' . $e->getMessage()]);
                return;
            }
    
            // check an error while user is create
            if (is_array($created_student) && isset($created_student['error'])) {
            $_SESSION['error'] =  $created_student['error'];
            header('location:../../views/dashbord/student.php');

            } else {
               $_SESSION['success'] = 'student created successfully';
            header('location:../../views/dashbord/student.php');

                
    
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

                    if (is_array($update_student) && isset($update_student['error'])) {
                        $_SESSION['error'] =  $update_student['error'];
                        header('location:../../views/dashbord/student.php');
                    } else {
                        $_SESSION['success'] = 'student created successfully';
                        header('location:../../views/dashbord/student.php');
                    }

                } else {
                    echo json_encode(['error' => 'student not found']);
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
            echo json_encode(['error' => 'No students found']);
        }
    }
}

// Connexion à la base de données et création de l'instance du contrôleur
// $database = new Database();
// $pdo = $database->connect();
$controller = new StudentController();

$json_student = $controller->getAllStudents();
$students = json_decode($json_student,true);

if(isset($_POST['addStudent'])) {
    $controller->createStudent();
}
if(isset($_POST['deleteStudent'])) {
    $controller->deleteStudent();
}
if(isset($_POST['updateStudent'])) {
    $controller->updateStudent();
}


