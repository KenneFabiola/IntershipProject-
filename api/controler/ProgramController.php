<?php
header('Content-Type: application/json');

require_once("../../Database.php");
require_once("../repositories/UserRepository.php");
require_once("../services/ProgramService.php");

class ProgramController {
    private $program_service;
    private $user_repository;

    public function __construct($pdo) {
        $this->program_service = new ProgramService($pdo);
        $this->user_repository = new UserRepository($pdo); // Pour les futures utilisations, si nécessaire
    }

    // Méthode pour créer un étudiant
    public function createprogram() {
      $id = 5;
      $user = $this->user_repository-> findById($id);
      if($user) {
        $created_by = $user->getId();
        $last_modified_by = $user->getId();

        // get data post
        $program_name = $_POST['program_name'] ?? null;
        $amount = $_POST['amount'] ?? null;
        $duration = $_POST['duration'] ?? null;

        
        // program objet
        $program = new program(
            null,
            $program_name,
            $amount,
            $duration,
            $created_by,
            $last_modified_by,
            null,
            false
        );
            // get service for authentification
        $created_program = $this->program_service->createProgram($program);

        if ($created_program) {
            echo json_encode(['success' => 'program created successfully']);
        } else {
            echo json_encode(['error' => 'Failed to create user']);
        }
    } else {
        echo json_encode(['error' => 'user not found']);

      }
    }

    // Méthode pour mettre à jour un étudiant
    public function updateprogram() {
        // Vérifier l'authentification de l'utilisateur
        $id = 5;
        $user = $this->user_repository->findById($id);
        if ($user) {
            $created_by = $user->getId();
            $last_modified_by = $user->getId();
            $input_data = json_decode(file_get_contents("php://input"), true);

            $id = $input_data['id'] ?? null;
            $user = $this->program_service->findById($id);

        $id = $input_data['id'] ?? null;
        $program = $this->program_service->findById($id);
        if ($program) {
            $program->setProgramName($input_data['program_name'] ?? $program->getProgramName());
            $program->setAmount($input_data['amount'] ?? $program->getAmount());
            $program->setDuration($input_data['duration'] ?? $program->getDuration());
            $program->setLastModifiedBy($last_modified_by);
            $program->setCreatedBy($program->getCreatedBy()); // Ne devrait pas être modifié lors de la mise à jour

            $updatedprogram = $this->program_service->updateprogram($program, $last_modified_by);
            if ($updatedprogram) {
                echo json_encode(['success' => 'program updated successfully']);
            } else {
                echo json_encode(['error' => 'Failed to update program']);
            }
        } else {
            echo json_encode(['error' => 'program not found']);
        }
    }
    }

    // delete program
    public function deleteprogram() {
        
        $input_data = json_decode(file_get_contents("php://input"), true);
        $id = $input_data['id'] ?? null;
        if ($id) {
            $deleted = $this->program_service->deleteProgram($id);
            if ($deleted) {
                echo json_encode(['success' => 'program deleted']);
            } else {
                echo json_encode(['error' => 'Failed to delete program']);
            }
        } else {
            echo json_encode(['error' => 'Program ID not provided']);
        }
    }

    // get program by id
    public function getprogramById($id) {
        $program = $this->program_service->findById($id);
        if ($program) {
            echo json_encode($program);
        } else {
            echo json_encode(['error' => 'program not found']);
        }
    }

    // get all program
    public function getAllprograms() {
        $students = $this->program_service->findAll();
        if ($students) {
            echo json_encode($students);
        } else {
            echo json_encode(['error' => 'No students found']);
        }
    }
}

$database = new Database();
$pdo = $database->connect();
$controller = new ProgramController($pdo);

// Gestion des requêtes HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createProgram();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller->updateProgram();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller->deleteProgram();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $controller->getProgramById($_GET['id']);
    } else {
        $controller->getAllPrograms();
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>