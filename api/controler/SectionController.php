<?php
require_once("../repositories/UserRepository.php");
require_once("../services/SectionService.php");

class SectionController {
    private $section_service;
    private $user_repository;

    public function __construct($pdo) {
        $this->section_service = new SectionService($pdo);
        $this->user_repository = new UserRepository($pdo); // Pour les futures utilisations, si nécessaire
    }

    //create section
    public function createSection() {
      $id = 27;
      $user = $this->user_repository-> findById($id);
      if($user) {
        $created_by = $user->getId();
        $last_modified_by = $user->getId();

        // get data post
        $school_year= $_POST['school_year'] ?? null;
        $statut = $_POST['statut'] ?? null;
        
        // objet section
        $section = new Section(
            null,
            null,
            $school_year,
            $created_by,
            $last_modified_by,
            false,
            $statut
        );
            // get service for authentification
        $createdSection = $this->section_service->createSection($section);

        if ($createdSection) {
            echo json_encode(['success' => 'section created successfully']);
        } else {
            echo json_encode(['error' => 'Failed to create section']);
        }
    } else {
        echo json_encode(['error' => 'user not found']);

      }
    }

    // update section
    public function updateSection() {
        
        $id = 27;
        $user = $this->user_repository->findById($id);
        if ($user) {
            $created_by = $user->getId();
            $last_modified_by = $user->getId();
            $input_data = json_decode(file_get_contents("php://input"), true);

            $id = $input_data['id'] ?? null;
            $user = $this->section_service->findById($id);

        $id = $input_data['id'] ?? null;
        $section = $this->section_service->findById($id);
        if ($section) {
            $section->setSchoolYear($input_data['school_year'] ?? $section->getSchoolYear());
            $section->setStatut($input_data['statut'] ?? $section->getStatut());
            $section->setLastModifiedBy($last_modified_by);
            $section->setCreatedBy($section->getCreatedBy()); // Ne devrait pas être modifié lors de la mise à jour

            $updateSection = $this->section_service->updateSection($section, $last_modified_by);
            if ($updateSection) {
                echo json_encode(['success' => 'Section updated successfully']);
            } else {
                echo json_encode(['error' => 'Failed to update section']);
            }
        } else {
            echo json_encode(['error' => 'Section not found']);
        }
    }
    }

    // delete section
    public function deleteSection() {
        
        $input_data = json_decode(file_get_contents("php://input"), true);
        $id = $input_data['id'] ?? null;
        if ($id) {
            $deleted = $this->section_service->deleteSection($id);
            if ($deleted) {
                echo json_encode(['success' => 'Section deleted']);
            } else {
                echo json_encode(['error' => 'Failed to delete section']);
            }
        } else {
            echo json_encode(['error' => 'User ID not provided']);
        }
    }

    // get section by id
    public function getSectionById($id) {
        $section = $this->section_service->findById($id);
        if ($section) {
            echo json_encode($section);
        } else {
            echo json_encode(['error' => 'Section not found']);
        }
    }

    // Méthode pour récupérer tous les étudiants
    public function getAllSections() {
        $sections = $this->section_service->findAll();
        if ($sections) {
            echo json_encode($sections);
        } else {
            echo json_encode(['error' => 'No sections found']);
        }
    }
}

// Connexion à la base de données et création de l'instance du contrôleur
$database = new Database();
$pdo = $database->connect();
$controller = new SectionController($pdo);

// Gestion des requêtes HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createSection();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller->updateSection();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller->deleteSection();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $controller->getSectionById($_GET['id']);
    } else {
        $controller->getAllSections();
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>