<?php
// header('Content-Type: application/json');

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'SectionService.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'TuitionService.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ProgramService.php';


class TuitionController
{
    private $tuition_service;
    private $user_repository;
    private $program_service;

    public function __construct()
    {
        $this->tuition_service = new TuitionService();
        $this->user_repository = new UserRepository();
        $this->program_service = new ProgramService();
    }

    // Méthode pour créer un étudiant
    public function createTuition()
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
        if (isset($_POST['addTuition'])) {

           $created_by =$_SESSION['id']; echo $created_by;

            $last_modified_by = $_SESSION['id'] ?? null; 
            $section_id = $_POST['section_id'] ?? null;  echo $section_id;
            $program_id = $_POST['program_id'];  echo $program_id;   
            $amount = $_POST['amount'];  echo $amount; 
           
          
              

            // get data post

            // Création de l'objet tuition
            $tuition = new Tuition(
                null,
                $created_by,
                $last_modified_by,
                $program_id,
                $section_id,
                $amount,
                null,
                false
            );
           
          
             // get service for authentification
            $createdTuition = $this->tuition_service->createTuition($tuition,$program_id);
           if( $createdTuition === 1) {
            // echo '1';
            $_SESSION['success'] = 'tuition created successfully';
            header('location:../../views/dashbord/program.php');

           }elseif( $createdTuition === 0) {
            // echo '0';
            $_SESSION['error'] = 'error during insertion';
            header('location:../../views/dashbord/program.php');
           }elseif( $createdTuition === 5){
            // echo '5';
            $_SESSION['error'] = 'Already define for this session, please change your session';
            header('location:../../views/dashbord/program.php');
            }else {
            echo 'error';
            $_SESSION['error'] = 'Vous ne pouvez pas définir de frais pour un programe fermé, veuillez ouvrir le programme avant';
            header('location:../../views/dashbord/program.php');

           }
         }
    }

    // update tuition
    public function updatetuition()
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
        // get data post 
        if(isset($_POST['updateTuition'])) {
            $id = intval($_POST['updateById']);
            $last_modified_by = ($_POST['last_modified_by']);
            $amount = htmlspecialchars($_POST['amount']); echo $amount;
            $program_id = $_POST['program_id']; echo $program_id;
            $section_id = $_POST['section_id']; echo $section_id;

            $tuition = $this->tuition_service->findById($id);

            if ($tuition) {
                $tuition->setLastModifiedBy($last_modified_by);
                $tuition->setAmount($amount ?? $tuition->getAmount());
                $tuition->setProgramId($program_id ?? $tuition->getProgramId());
                $tuition->setSectionId($section_id ?? $tuition->getSectionId());
                // print_r($tuition);
               
                $update_tuition = $this->tuition_service->updatetuition($tuition);
                if($update_tuition === 1) {
                    $_SESSION['success'] = 'tuition updated successfully';
                    header('location:../../views/dashbord/program.php');
        
                   }else {
                    $_SESSION['error'] = 'failed to update student';
                    header('location:../../views/dashbord/program.php');
        
                   }
            } 
        }
        
    }

    // delete tuition
    public function deleteTuition()
    {

      if(isset($_POST['deleteTuition'])) {
        $id = intval($_POST['deleteTuitionById']);
        var_dump($id);

        $deleted = $this->tuition_service->deleteTuition($id);
        if($deleted) {
            echo json_encode(['success' => 'Tuition deleted']);
                header('location:../../views/dashbord/program.php');
        }else {
            echo json_encode(['error' => 'Failed to delete tuition']);
        }
      }else {
        echo json_encode(['error' => 'Tuition ID not provided']);
    }
    }

    // Méthode pour récupérer un étudiant par ID
    public function getTuitionById($id)
    {
        $tuition = $this->tuition_service->findById($id);
        if ($tuition) {
            echo json_encode($tuition);
        } else {
            echo json_encode(['error' => 'tuition not found']);
        }
    }

    // Méthode pour récupérer tous éléments de la table tuition
    public function getAlltuitions()
    {
        $tuitions = $this->tuition_service->findAllTuition();
        if ($tuitions) {
            // echo '<pre>';
            // print_r($tuitions);
            // echo ' </pre>';
            return json_encode($tuitions);
        } else {
            echo json_encode(['error' => 'No tuitions found']);
        }
    }
    public function getAlltuitionForSessionId($section_id)
    {
        $tuitions = $this->tuition_service->findTuitionBySectionId($section_id);
        if ($tuitions) {
            // echo '<pre>';
            // print_r($tuitions);
            // echo ' </pre>';
            return json_encode($tuitions);
        } else {
            echo json_encode(['error' => 'No tuitions found']);
        }
    }

    // find program name 
    public function findProgramName()
    {
        $program_name = $this->program_service->findAllProgram();
        if ($program_name) {
            return json_encode($program_name);
        } else {
            echo json_encode(['error' => 'No program found']);
        }
    }

    public function findProgramBySession($section_id) {
        $programs = $this->tuition_service->findProgramBySession($section_id);
        if($programs) {
            
            return json_encode($programs);
        } else {
            echo json_encode(['error' => 'No program found']);

        }

    }
}


$tuition_controller = new TuitionController();

if (isset($_POST['addTuition'])) {
    $tuition_controller->createTuition();
}
if (isset($_POST['updateTuition'])) {
    $tuition_controller->updateTuition();
}
if (isset($_POST['deleteTuition'])) {
    $tuition_controller->deleteTuition();
}
$json_tuition = $tuition_controller->getAlltuitions();
$json_program = $tuition_controller->findProgramName();

















 // if(!isset($_POST['programs']) || !is_array($_POST['programs'])) {
            //     echo json_encode(['error' => 'invalid programs data']);
            //     exit();

            // }
            // foreach( $_POST['programs'] as  $program_data) {
            //     echo 'ok';
            //     // echo is_array($_POST['programs']);
            //     $program_id = $program_data['program_id'] ?? null;
            //     $program = $program_data['program_name'] ?? null; echo $program;
            //     $amount = $program_data['amount'] ?? null; 


            //     if ($program_id && $program && $amount) {
            //         echo ' success'; 
            //         die();
            //     }
               

            // }
           
           
