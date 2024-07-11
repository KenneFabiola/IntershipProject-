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

    public function __construct($pdo)
    {
        $this->tuition_service = new TuitionService($pdo);
        $this->user_repository = new UserRepository($pdo);
        $this->program_service = new ProgramService($pdo);
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
            $program = $_POST['program_name'];  echo $program;
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
                $program,
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
    // public function updatetuition()
    // {

    //     $id = 5;
    //     $user = $this->user_repository->findById($id);
    //     if ($user) {
    //         $created_by = $user->getId();
    //         $last_modified_by = $user->getId();
    //         $input_data = json_decode(file_get_contents("php://input"), true);

    //         $id = $input_data['id'] ?? null;
    //         $user = $this->tuition_service->findById($id);

    //         $id = $input_data['id'] ?? null;
    //         $tuition = $this->tuition_service->findById($id);
    //         if ($tuition) {
    //             $tuition->setProgramId($input_data['program_id'] ?? $tuition->getProgramId());
    //             $tuition->setSectionId($input_data['section_id'] ?? $tuition->getSectionId());
    //             $tuition->setLastModifiedBy($last_modified_by);
    //             $tuition->setCreatedBy($tuition->getCreatedBy());
    //             $tuition->setProgram($input_data['program'] ?? $tuition->getProgram());
    //             $tuition->setCreatedAt($input_data['created_at'] ?? $tuition->getCreatedAt());
    //             $tuition->setDeleted($input_data['deleted'] ?? $tuition->getDeleted());

    //             $updatetuition = $this->tuition_service->updatetuition($tuition, $last_modified_by);
    //             if ($updatetuition) {
    //                 echo json_encode(['success' => 'tuition updated successfully']);
    //             } else {
    //                 echo json_encode(['error' => 'Failed to update tuition']);
    //             }
    //         } else {
    //             echo json_encode(['error' => 'tuition not found']);
    //         }
    //     }
    // }

    // delete tuition
    public function deleteTuition()
    {

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
                 echo '<pre>';
            print_r($tuitions);
           echo ' </pre>';
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
$database = new Database();
$pdo = $database->connect();
$controller = new TuitionController($pdo);

if (isset($_POST['addTuition'])) {
    $controller->createTuition();
}
if (isset($_POST['updateTuition'])) {
    // $controller->updateTuition();
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
           
           
