<?php
//  header('Content-Type: application/json');


require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ProgramService.php';


class ProgramController
{
    private $program_service;
    private $user_repository;

    public function __construct($pdo)
    {
        $this->program_service = new ProgramService($pdo);
        $this->user_repository = new UserRepository($pdo); // Pour les futures utilisations, si nécessaire
    }


    // verified the authentification of user


    //create program
    public function createprogram()
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

            if ($created_program) {
                echo json_encode(['success' => 'program created successfully']);
            } else {
                echo json_encode(['error' => 'Failed to create program']);
            }
        }
    }

    // Méthode pour mettre à jour un étudiant
    public function updateprogram()
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



        $created_by = $_SESSION['id'];
        $last_modified_by = $_SESSION['id'];
        $input_data = json_decode(file_get_contents("php://input"), true);

        $id = $input_data['id'] ?? null;
        $user = $this->program_service->findById($id);

        $id = $input_data['id'] ?? null;
        $program = $this->program_service->findById($id);
        if ($program) {
            $program->setProgramName($input_data['program_name'] ?? $program->getProgramName());
            $program->setDescriptive($input_data['amount'] ?? $program->getDescriptive());
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

    // delete program
    public function deleteprogram()
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
    public function getprogramById($id)
    {
        $program = $this->program_service->findById($id);
        if ($program) {
            echo json_encode($program);
        } else {
            echo json_encode(['error' => 'program not found']);
        }
    }

    // get all program
    public function getAllprograms()
    {
        $programs = $this->program_service->findAllProgram();
        if ($programs) {
            return json_encode($programs);
        } else {
            echo json_encode(['error' => 'No program found']);
        }
    }
}

$database = new Database();
$pdo = $database->connect();
$controller = new ProgramController($pdo);

$json_program = $controller->getAllprograms();
$programs = json_decode($json_program, true);

if (isset($_POST['deleteProgram'])) {
    $controller->deleteprogram();
}
if (isset($_POST['addProgram'])) {
    $controller->createprogram();
}




