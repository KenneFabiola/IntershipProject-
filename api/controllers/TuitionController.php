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
            $createdTuition = $this->tuition_service->createTuition($tuition);
            if (is_array($createdTuition) && isset($createdTuition['error'])) {
                echo json_encode(['error' => $createdTuition['error']]);
            }
            elseif ($createdTuition) {
                echo json_encode(['success' => 'tuition created successfully']);
            } else {
                echo json_encode(['error' => 'Failed to create Tuition']);
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
                if (is_array($update_tuition) && isset($update_tuition['error'])) {
                    $_SESSION['error'] =  $update_tuition['error'];
                    header('location:../../views/dashbord/program.php');
                } else {
                    $_SESSION['success'] = 'tuition updated successfully';
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

    // find program name 
    public function findProgramName()
    {
        $program_name = $this->program_service->findAllProgram();
        if ($program_name) {
        //     echo '<pre>';
        //     print_r($program_name);
        //    echo ' </pre>';
            return json_encode($program_name);
        } else {
            echo json_encode(['error' => 'No program found']);
        }
    }
}

// Connexion à la base de données et création de l'instance du contrôleur
// $database = new Database();
//  = $database->connect();
$controller = new TuitionController();

if (isset($_POST['addTuition'])) {
    $controller->createTuition();
}
if (isset($_POST['updateTuition'])) {
    $controller->updateTuition();
}
if (isset($_POST['deleteTuition'])) {
    $controller->deleteTuition();
}
$json_tuition = $controller->getAlltuitions();
$json_program = $controller->findProgramName();

$tuitions = json_decode($json_tuition, true);
$programs = json_decode($json_program, true);















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
           
           
