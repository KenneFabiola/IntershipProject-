<?php
header('Content-Type: application/json');
require_once("../../Database.php");
require_once("../repositories/UserRepository.php");
require_once("../repositories/ProgramRepository.php");
require_once("../repositories/SectionRepository.php");
require_once("../repositories/StudentRepository.php");
require_once("../repositories/RegistrationRepository.php");


class RegistrationController {
    private $registration_service;
    private $user_repository;
    private $student_repository;
    private $section_repository;
    private $program_repository;

    public function __construct($pdo) {
        $this->registration_service = new RegistrationService($pdo);
        $this->user_repository = new UserRepository($pdo); 
        $this->student_repository = new StudentRepository($pdo); 
        $this->section_repository = new SectionRepository($pdo);
        $this->program_repository = new ProgramRepository($pdo);
    }

    // create registration
    public function createRegistration() {
      $id = 5;
      $student_id = 3;
      $section_id= 4;
      $program_id = 5;

      $user = $this->user_repository-> findById($id);
      $section = $this->section_repository->findById($section_id);
      $program = $this->program_repository->findById($program_id);
      $student = $this->student_repository->findById($student_id);

      if($user && $section && $program && $student) {
        $created_by = $user->getId();
        $last_modified_by = $user->getId();
        $program_id = $program->getId();
        $section_id = $section->getId();
        $student_id = $student->getId();
        
        // Création de l'objet registration
        $registration = new Registration(
            null,
            $student_id,
            $section_id,
            $program_id,
            $created_by,
            $last_modified_by,
            null,
            false
        );
            // get service for authentification
        $createdRegistration = $this->registration_service->createregistration($registration);

        if ($createdRegistration) {
            echo json_encode(['success' => 'Registration created successfully']);
        } else {
            echo json_encode(['error' => 'Failed to create Registration']);
        }
    } else {
        echo json_encode(['error' => 'user or section or program not found']);

      }
    }

    // update registration
    public function updateRegistration() {
    
        $id = 5;
        $user = $this->user_repository->findById($id);
        if ($user) {
            $created_by = $user->getId();
            $last_modified_by = $user->getId();
            $input_data = json_decode(file_get_contents("php://input"), true);

            $id = $input_data['id'] ?? null;
            $user = $this->registration_service->findById($id);

        $id = $input_data['id'] ?? null;
        $registration = $this->registration_service->findById($id);
        if ($registration) {
            $registration->setStudentId($input_data['student_id'] ?? $registration->getStudentId());
            $registration->setSectionId($input_data['section_id'] ?? $registration->getSectionId());
            $registration->setProgramId($input_data['program_id'] ?? $registration->getProgramId());
            $registration->setLastModifiedBy($last_modified_by);
            $registration->setCreatedBy($registration->getCreatedBy());
            $registration->setCreatedAt($input_data['created_at'] ?? $registration->getCreatedAt());
            $registration->setDeleted($input_data['deleted'] ?? $registration->getDeleted());
                
            $updateregistration = $this->registration_service->updateregistration($registration, $last_modified_by);
            if ($updateregistration) {
                echo json_encode(['success' => 'registration updated successfully']);
            } else {
                echo json_encode(['error' => 'Failed to update registration']);
            }
        } else {
            echo json_encode(['error' => 'registration not found']);
        }
    }
    }

    // delete registration
    public function deleteregistration() {
        
        $input_data = json_decode(file_get_contents("php://input"), true);
        $id = $input_data['id'] ?? null;
        if ($id) {
            $deleted = $this->registration_service->deleteregistration($id);
            if ($deleted) {
                echo json_encode(['success' => 'registration deleted']);
            } else {
                echo json_encode(['error' => 'Failed to delete registration']);
            }
        } else {
            echo json_encode(['error' => 'registration ID not provided']);
        }
    }

    // Méthode pour récupérer un étudiant par ID
    public function getRegistrationById($id) {
        $registration = $this->registration_service->findById($id);
        if ($registration) {
            echo json_encode($registration);
        } else {
            echo json_encode(['error' => 'registration not found']);
        }
    }

    // Méthode pour récupérer tous les étudiants
    public function getAllRegistrations() {
        $registrations = $this->registration_service->findAll();
        if ($registrations) {
            echo json_encode($registrations);
        } else {
            echo json_encode(['error' => 'No registrations found']);
        }
    }
}

// Connexion à la base de données et création de l'instance du contrôleur
$database = new Database();
$pdo = $database->connect();
$controller = new registrationController($pdo);

// Gestion des requêtes HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createRegistration();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller->updateRegistration();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller->deleteRegistration();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $controller->getRegistrationById($_GET['id']);
    } else {
        $controller->getAllregistrations();
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>