<?php
//  header('Content-Type: application/json');


require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ProgramService.php';


class ProgramController
{
    private $program_service;
    private $user_repository;

    public function __construct()
    {
        $this->program_service = new ProgramService();
        $this->user_repository = new UserRepository(); // Pour les futures utilisations, si nécessaire
    }


    // verified the authentification of user


    //create program
    public function createProgram()
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

        if (isset($_POST['addProgram'])) {
            $created_by = $_SESSION['id'];
            $last_modified_by = $_SESSION['id'];

            // get data post
            $program_name = $_POST['program_name'] ?? null;
            $amount = $_POST['describe'] ?? null;
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

            if (is_array($created_program) && isset($created_program['error'])) {
                $_SESSION['error'] = $created_program['error'];
                header('location:../../views/dashbord/program.php');
            } else {
                $_SESSION['success'] = 'program created successfully';
                header('location:../../views/dashbord/program.php');

            }
        }
    }

    // Méthode pour mettre à jour un étudiant
    public function updateProgram()
    {
        // check if authentification is ok
        if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
            echo json_encode(['error' => 'unauthorized']);
            exit();
        }

        // check authentification of user
        if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) { {
                echo json_encode(['error' => 'unauthorized']);
                exit();
            }
        }
    if(isset($_POST['updateProgram'])) {
        $last_modified_by = $_SESSION['id'];
        $id = intval($_POST['updateProgramById']); 
        $program_name = htmlspecialchars($_POST['program_name'] ?? null);
        $descriptive = htmlspecialchars($_POST['descriptive'] ?? null);
        $duration = htmlspecialchars($_POST['duration'] ?? null);  
  
        $program = $this->program_service->findById($id);
        if ($program) {
            $program->setProgramName($program_name ?? $program->getProgramName());
            $program->setDescriptive($descriptive ?? $program->getDescriptive());
            $program->setDuration($duration ?? $program->getDuration());
            $program->setLastModifiedBy($last_modified_by);
           
            $updated_program = $this->program_service->updateprogram($program);
            if ($updated_program) {
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
    public function deleteProgram()
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

        if (isset($_POST['deleteProgram'])) {

            $id = intval($_POST['deleteProgramById']);

            $deleted = $this->program_service->deleteProgram($id);
            if ($deleted) {
                echo json_encode(['success' => 'program deleted successfully']);
                header('location:../../views/dashbord/program.php');
            } else {
                echo json_encode(['error' => 'failed to delete program']);
            }
        } else {
            echo json_encode(['error' => 'Program ID not provided']);
        }
    }

    // get program by id
    public function getProgramById($id)
    {
        $program = $this->program_service->findById($id);
        if ($program) {
            echo json_encode($program);
        } else {
            echo json_encode(['error' => 'program not found']);
        }
    }

    // get all program
    public function getAllPrograms()
    {
        $programs = $this->program_service->findAllProgram();
        if ($programs) {
            return json_encode($programs);
        } else {
            echo json_encode(['error' => 'No program found']);
        }
    }
}

// $database = new Database();
// $pdo = $database->connect();
$controller = new ProgramController();

$json_program = $controller->getAllPrograms();
$programs = json_decode($json_program, true);

if (isset($_POST['deleteProgram'])) {
    $controller->deleteProgram();
}
if (isset($_POST['addProgram'])) {
    $controller->createProgram();
}
if (isset($_POST['updateProgram'])) {
    $controller->updateProgram();
}




