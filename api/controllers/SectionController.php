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
            $school_year=htmlspecialchars($_POST['school_year']);
            $month=htmlspecialchars($_POST['month']);
 
              // objet section
              $section = new Section(
                  null,
                  null,
                  $school_year,
                  $month,
                  $created_by,
                  $last_modified_by,
                  false,
                  null
              );
              print_r($section);
                  // get service for authentification
              $createdSection = $this->section_service->createSection($section);
      
              if($createdSection === 3) {
                $_SESSION['error'] = 'Vous ne pouvez pas avoir plus de deux session en cours, veuillez terminé la session avant de debuter un nouvelle';
                header('location:../../views/dashbord/education.php');
                
            }elseif($createdSection === 1) {
                $_SESSION['success'] = 'Nouvelle session crée';
            header('location:../../views/dashbord/education.php');
                
              }elseif($createdSection === 4) {
                $_SESSION['error'] = 'cet session existe déjà';
                header('location:../../views/dashbord/education.php');
                
              }
              else {
                 $_SESSION['error'] = 'unknown type an error';
                 header('location:../../views/dashbord/education.php');

              }
         
        }

      
    }

    // update section
    public function updateSection() {
         // check if authentification is ok
         if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
            echo json_encode(['error' => 'unauthorized']);
            exit();
        }

        // check authentification of user
        if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) { 
                echo json_encode(['error' => 'unauthorized']);
                exit();
            }

     if(isset($_POST['updateSection'])) {

        $id = intval($_POST['updateSessionById']); 
        $last_modified_by = htmlspecialchars($_POST['last_modified_by']);          
        $school_year =htmlspecialchars($_POST['school_year']); 
        $month =htmlspecialchars($_POST['month']); 

        $section = $this->section_service->findById($id);
        if($section) {
            $section->setSchoolYear($school_year ?? $section->getSchoolYear());
            $section->setMonth($month ?? $section->getMonth()); 
            $section->setLastModifiedBy($last_modified_by);

            $updated_section = $this->section_service->updateSection($section);
            if($updated_section === 3) {
                // $_SESSION['error'] = 'Vous ne pouvez pas avoir plus de deux session en cours, veuillez terminé la session avant de debuter un nouvelle';
                // header('location:../../views/dashbord/education.php');
                
            }elseif($updated_section === 1) {
                echo 'ok';
            //     $_SESSION['success'] = 'Nouvelle session crée';
            // header('location:../../views/dashbord/education.php');
                
              }elseif($updated_section === 4) {
                echo 'already';
                // $_SESSION['error'] = 'cet session existe déjà';
                // header('location:../../views/dashbord/education.php');
                
              }
              else {
                echo 'rr';
                //  $_SESSION['error'] = 'unknown type an error';
                //  header('location:../../views/dashbord/education.php');

              }
  
        }


     }   
       
    }

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
if(isset($_POST['updateSection'])) {
    $controller->updateSection();
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

