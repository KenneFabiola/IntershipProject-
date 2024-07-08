<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'StudentService.php';

class StudentController
{
    private $student_service;
    private $user_repository;

    public function __construct($pdo)
    {
        $this->student_service = new StudentService($pdo);
        $this->user_repository = new UserRepository($pdo); // Pour les futures utilisations, si nécessaire
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
            $program = htmlspecialchars($_POST['program'] ?? null);


            // Création de l'objet User
            $student = new Student(
                null,
                $username,
                $first_name,
                $last_name,
                $email,
                $pwd,
                $program,
                $created_by,
                $last_modified_by,
                null,
                false
            );
            // get service for authentification
            $created_student = $this->student_service->createStudent($student);
            if (is_array($created_student) && isset($created_student['error'])) {
                echo json_encode(['error' => $created_student['error']]);
            } else {
                echo json_encode(['success' => 'student created successfully']);
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
            
            $last_modified_by = $_SESSION['id'];
           
                           // get data post                
                $id = intval($_POST['updateStudentById']);
                $username = htmlspecialchars($_POST['username'] ?? null);
                $first_name = htmlspecialchars($_POST['first_name'] ?? null);
                $last_name = htmlspecialchars($_POST['last_name'] ?? null);
                $email = htmlspecialchars($_POST['email'] ?? null);
                $program = htmlspecialchars($_POST['program'] ?? null);
                $deleted = false;
                $student = $this->student_service->findById($id);

                if($student) {
                    $student->setUsername($username?? $student->getUsername());
                    $student->setFirstName($first_name ?? $student->getFirstName());
                    $student->setLastName($last_name ?? $student->getLastName());
                    $student->setEmail($email ?? $student->getEmail());
                    $student->setProgram($program ?? $student->getProgram());
                    $student->setLastModifiedBy($last_modified_by ?? $student->getLastModifiedBy());

                    $update_student= $this->student_service->updateStudent($student);

                    if($update_student) {
                        echo json_encode(['success' => 'Student update successfully']);
                    }else {
                        echo json_encode(['error' => 'failed to update student']);
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
$database = new Database();
$pdo = $database->connect();
$controller = new StudentController($pdo);

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


