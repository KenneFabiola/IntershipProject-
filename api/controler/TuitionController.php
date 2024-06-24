<?php
require_once("../../Database.php");
require_once("../repositories/UserRepository.php");
require_once("../repositories/ProgramRepository.php");
require_once("../repositories/SectionRepository.php");
require_once("../services/TuitionService.php");

class TuitionController {
    private $tuition_service;
    private $user_repository;
    private $section_repository;
    private $program_repository;

    public function __construct($pdo) {
        $this->tuition_service = new TuitionService($pdo);
        $this->user_repository = new UserRepository($pdo); 
        $this->section_repository = new SectionRepository($pdo);
        $this->program_repository = new ProgramRepository($pdo);
    }

    // Méthode pour créer un étudiant
    public function createTuition() {
      $id = 5;
      $section_id= 4;
      $program_id = 5;

      $user = $this->user_repository-> findById($id);
      $section = $this->section_repository->findById($section_id);
      $program = $this->program_repository->findById($program_id);

      if($user && $section && $program) {
        $created_by = $user->getId();
        $last_modified_by = $user->getId();
        $program_id = $program->getId();
        $section_id = $section->getId();
        
        // get data post
       
        $program = $_POST['program'];

        
        // Création de l'objet tuition
        $tuition = new Tuition(
            null,
            $created_by,
            $last_modified_by,
            $program_id,
            $section_id,
            $program,
            null,
            false
        );
            // get service for authentification
        $createdTuition = $this->tuition_service->createTuition($tuition);

        if ($createdTuition) {
            echo json_encode(['success' => 'tuition created successfully']);
        } else {
            echo json_encode(['error' => 'Failed to create user']);
        }
    } else {
        echo json_encode(['error' => 'user or section or program not found']);

      }
    }

    // update tuition
    public function updatetuition() {
    
        $id = 5;
        $user = $this->user_repository->findById($id);
        if ($user) {
            $created_by = $user->getId();
            $last_modified_by = $user->getId();
            $input_data = json_decode(file_get_contents("php://input"), true);

            $id = $input_data['id'] ?? null;
            $user = $this->tuition_service->findById($id);

        $id = $input_data['id'] ?? null;
        $tuition = $this->tuition_service->findById($id);
        if ($tuition) {
            $tuition->setProgramId($input_data['program_id'] ?? $tuition->getProgramId());
            $tuition->setSectionId($input_data['section_id'] ?? $tuition->getSectionId());
            $tuition->setLastModifiedBy($last_modified_by);
            $tuition->setCreatedBy($tuition->getCreatedBy());
            $tuition->setProgram($input_data['program'] ?? $tuition->getProgram());
            $tuition->setCreatedAt($input_data['created_at'] ?? $tuition->getCreatedAt());
            $tuition->setDeleted($input_data['deleted'] ?? $tuition->getDeleted());
                
            $updatetuition = $this->tuition_service->updatetuition($tuition, $last_modified_by);
            if ($updatetuition) {
                echo json_encode(['success' => 'tuition updated successfully']);
            } else {
                echo json_encode(['error' => 'Failed to update tuition']);
            }
        } else {
            echo json_encode(['error' => 'tuition not found']);
        }
    }
    }

    // delete tuition
    public function deleteTuition() {
        
        $input_data = json_decode(file_get_contents("php://input"), true);
        $id = $input_data['id'] ?? null;
        if ($id) {
            $deleted = $this->tuition_service->deleteTuition($id);
            if ($deleted) {
                echo json_encode(['success' => 'tuition deleted']);
            } else {
                echo json_encode(['error' => 'Failed to delete tuition']);
            }
        } else {
            echo json_encode(['error' => 'Tuition ID not provided']);
        }
    }

    // Méthode pour récupérer un étudiant par ID
    public function getTuitionById($id) {
        $tuition = $this->tuition_service->findById($id);
        if ($tuition) {
            echo json_encode($tuition);
        } else {
            echo json_encode(['error' => 'tuition not found']);
        }
    }

    // Méthode pour récupérer tous les étudiants
    public function getAlltuitions() {
        $tuitions = $this->tuition_service->findAll();
        if ($tuitions) {
            echo json_encode($tuitions);
        } else {
            echo json_encode(['error' => 'No tuitions found']);
        }
    }
}

// Connexion à la base de données et création de l'instance du contrôleur
$database = new Database();
$pdo = $database->connect();
$controller = new TuitionController($pdo);

// Gestion des requêtes HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createTuition();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller->updateTuition();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller->deleteTuition();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $controller->getTuitionById($_GET['id']);
    } else {
        $controller->getAllTuitions();
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>