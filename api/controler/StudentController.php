<?php
require_once("../../Database.php");
require_once("../repositories/UserRepository.php");
require_once("../services/StudentService.php");

class StudentController {
    private $student_service;
    private $user_repository;

    public function __construct($pdo) {
        $this->student_service = new StudentService($pdo);
        $this->user_repository = new UserRepository($pdo); // Pour les futures utilisations, si nécessaire
    }

    // Méthode pour créer un étudiant
    public function createStudent() {
      $id = 27;
      $user = $this->user_repository-> findById($id);
      if($user) {
        $created_by = $user->getId();
        $last_modified_by = $user->getId();

        // get data post
        $username = $_POST['username'] ?? null;
        $first_name = $_POST['first_name'] ?? null;
        $last_name = $_POST['last_name'] ?? null;
        $email = $_POST['email'] ?? null;
        $pwd = $_POST['pwd'] ?? null;
        $program = $_POST['program'] ?? null;

        
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
        $createdStudent = $this->student_service->createStudent($student);

        if ($createdStudent) {
            echo json_encode(['success' => 'student created successfully']);
        } else {
            echo json_encode(['error' => 'Failed to create user']);
        }
    } else {
        echo json_encode(['error' => 'user not found']);

      }
    }

    // Méthode pour mettre à jour un étudiant
    public function updateStudent() {
        // Vérifier l'authentification de l'utilisateur
        $id = 27;
        $user = $this->user_repository->findById($id);
        if ($user) {
            $created_by = $user->getId();
            $last_modified_by = $user->getId();
            $input_data = json_decode(file_get_contents("php://input"), true);

            $id = $input_data['id'] ?? null;
            $user = $this->student_service->findById($id);

        $id = $input_data['id'] ?? null;
        $student = $this->student_service->findById($id);
        if ($student) {
            $student->setUsername($input_data['username'] ?? $student->getUsername());
            $student->setFirstName($input_data['first_name'] ?? $student->getFirstName());
            $student->setLastName($input_data['last_name'] ?? $student->getLastName());
            $student->setEmail($input_data['email'] ?? $student->getEmail());
            $student->setPwd($input_data['pwd'] ?? $student->getPwd());
            $student->setProgram($input_data['program'] ?? $student->getProgram());
            $student->setLastModifiedBy($last_modified_by);
            $student->setCreatedBy($student->getCreatedBy()); // Ne devrait pas être modifié lors de la mise à jour

            $updatedStudent = $this->student_service->updateStudent($student, $last_modified_by);
            if ($updatedStudent) {
                echo json_encode(['success' => 'Student updated successfully']);
            } else {
                echo json_encode(['error' => 'Failed to update student']);
            }
        } else {
            echo json_encode(['error' => 'Student not found']);
        }
    }
    }

    // delete student
    public function deleteStudent() {
        
        $input_data = json_decode(file_get_contents("php://input"), true);
        $id = $input_data['id'] ?? null;
        if ($id) {
            $deleted = $this->student_service->deleteStudent($id);
            if ($deleted) {
                echo json_encode(['success' => 'Student deleted']);
            } else {
                echo json_encode(['error' => 'Failed to delete student']);
            }
        } else {
            echo json_encode(['error' => 'User ID not provided']);
        }
    }

    // Méthode pour récupérer un étudiant par ID
    public function getStudentById($id) {
        $student = $this->student_service->findById($id);
        if ($student) {
            echo json_encode($student);
        } else {
            echo json_encode(['error' => 'Student not found']);
        }
    }

    // Méthode pour récupérer tous les étudiants
    public function getAllStudents() {
        $students = $this->student_service->findAll();
        if ($students) {
            echo json_encode($students);
        } else {
            echo json_encode(['error' => 'No students found']);
        }
    }
}

// Connexion à la base de données et création de l'instance du contrôleur
$database = new Database();
$pdo = $database->connect();
$controller = new StudentController($pdo);

// Gestion des requêtes HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createStudent();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller->updateStudent();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller->deleteStudent();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $controller->getStudentById($_GET['id']);
    } else {
        $controller->getAllStudents();
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>