<?php
// header('Content-Type: application/json');
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'SectionService.php';


class SectionController {
    private $section_service;
    
    public function __construct() {
        $this->section_service = new SectionService();
         
    }
    //create section
    public function createSection() {
        
        if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
            echo json_encode(['error' => 'unauthorized']);
            exit();
        }

        if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) { {
                echo json_encode(['error' => 'unauthorized']);
                exit();
            }
        }

        if (isset($_POST['addSection'])) {
            $created_by = $_SESSION['id'];
            $last_modified_by = $_SESSION['id'];              
              // get data post
              $school_year=htmlspecialchars($_POST['school_year'] ?? null);
              $statut = htmlspecialchars($_POST['statut'] ?? 'active');
            
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
         
        }

      
    }

    // update section
    // public function updateSection() {
        
    //     $id = 5;
    //     $user = $this->user_repository->findById($id);
    //     if ($user) {
    //         $created_by = $user->getId();
    //         $last_modified_by = $user->getId();
    //         $input_data = json_decode(file_get_contents("php://input"), true);

    //         $id = $input_data['id'] ?? null;
    //         $user = $this->section_service->findById($id);

    //     $id = $input_data['id'] ?? null;
    //     $section = $this->section_service->findById($id);
    //     if ($section) {
    //         $section->setSchoolYear($input_data['school_year'] ?? $section->getSchoolYear());
    //         $section->setStatut($input_data['statut'] ?? $section->getStatut());
    //         $section->setLastModifiedBy($last_modified_by);
    //         $section->setCreatedBy($section->getCreatedBy()); // Ne devrait pas être modifié lors de la mise à jour

    //         $updateSection = $this->section_service->updateSection($section, $last_modified_by);
    //         if ($updateSection) {
    //             echo json_encode(['success' => 'Section updated successfully']);
    //         } else {
    //             echo json_encode(['error' => 'Failed to update section']);
    //         }
    //     } else {
    //         echo json_encode(['error' => 'Section not found']);
    //     }
    // }
    // }

    // delete section
    public function deleteSection() {
        
       
      if(isset($_POST['deleteSection'])) {
        $id = intval($_POST['deleteSectionById']);
        var_dump($id);

        $deleted = $this->section_service->deleteSection($id);
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

    //  finish section
    public function finishSection() {
        
      if(isset($_POST['finishSection'])) {

        $id = intval($_POST['finishSectionById']);
        $last_modified_by = $_SESSION['id'];
        var_dump($id);

        
        $section = $this->section_service->findById($id);
        if ($section) {
            $section->setLastModifiedBy($last_modified_by ?? $section->getLastModifiedBy());
            $finished = $this->section_service->finishSection($id);
            if($finished) {
                echo json_encode(['success' => 'session is finished successfully']);
                    header('location:../../views/dashbord/student.php');
            }else {
                echo json_encode(['error' => 'Failed to finish section']);
            }
        }
      
      }else {
        echo json_encode(['error' => 'Section ID not provided']);
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
        $sections = $this->section_service->findAllSection();
      
        if ($sections) {
            
            return json_encode($sections);

        } else {
            return json_encode(['error' => 'No sections found']);
        }
    }

    public function getInactiveSection() {
        $inactive_section = $this->section_service->getInactiveSection();
        if($inactive_section) {
       
            return json_encode($inactive_section);

        }else {
            echo json_encode (['error' => 'Section not found']);
        }
    }
}

// Connexion à la base de données et création de l'instance du contrôleur
// $database = new Database();
//  $pdo= $database->connect();
$controller = new SectionController();

$json_section = $controller->getAllSections();
$sections = json_decode($json_section,true);

$json_inactive_section = $controller->getInactiveSection();
$inactive_section = json_decode($json_inactive_section,true);

if(isset($_POST['addSection'])) {
    $controller->createSection();
}
if(isset($_POST['finishSection'])) {
    $controller->finishSection();
}
if(isset($_POST['deleteStudent'])) {
    $controller->deleteSection();
}
// if(isset($_POST['updateStudent'])) {
//     $controller->updateSection();
// }

