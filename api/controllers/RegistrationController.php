<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'RegistrationService.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';

class RegistrationController {
    private $registration_service;
   

    public function __construct() {
        $this->registration_service = new RegistrationService();
      
    }
    // create registration
    public function createRegistration() {
        if(isset($_POST['addRegistration'])) {
            $student_id = htmlspecialchars($_POST['registrationStudentId']);
            $section_id = htmlspecialchars($_POST['registrationSectionId']);
            $program_id = htmlspecialchars($_POST['registrationProgramId']);
            $created_by = $_SESSION['id'];
            $last_modified_by = $_SESSION['id'];
        
            // create registration objet
            $registration = new Registration(
                null,
                $student_id,
                $section_id,
                $program_id,
                $created_by,
                $last_modified_by,
                null,
                null,
                false
            );
            // print_r($registration);
                // get service for authentification
            $created_registration = $this->registration_service->createregistration($registration);
            if ($created_registration === 3 ) {
                $_SESSION['error'] = 'cet etudiant à déjà été enregistrer pour ce niveau et pour cette filière';
                header('location:../../views/dashbord/education.php');
                
            } elseif($created_registration === 4) {
                $_SESSION['success'] = 'Enregistrement effectué';
                header('location:../../views/dashbord/education.php');


            }elseif($created_registration === 5) {
                $_SESSION['success'] = 'Enregistrement mis à jour';
                header('location:../../views/dashbord/education.php');


            }elseif($created_registration === 6) {
                $_SESSION['error'] = "Un etudiant ne peut pas faire plus de deux programme au cours d'une année académique ";
                header('location:../../views/dashbord/education.php');

            }
              else {
                $_SESSION['error'] = 'Erreur, veuillez ressayer';
                header('location:../../views/dashbord/education.php');


            }
        }
    
    }

    // update registration
    public function updateRegistration() {
        if(isset($_POST['updateRegistration'])) {
            $id = intval($_POST['registrationId']); echo $id;
            // $student_id = intval($_POST['studentId']);
            $program_id = intval($_POST['programId']); 
            $last_modified_by = intval($_POST['last_modified_by']);

            $registration = $this->registration_service->findById($id);

            if($registration) {
                $registration->setProgramId($program_id ?? $registration->getStudentId());
                $registration->setLastModifiedBy($last_modified_by ?? $registration->getLastModifiedBy());

                $update_registration = $this->registration_service->updateRegistration($registration);

                if($update_registration === 1) {
                    $_SESSION['success'] = 'program updated successfully for this student';
                     header('location:../../views/dashbord/education.php');

                     
                }else {
                    $_SESSION['error'] = 'failed to update preogram for this student';
                    header('location:../../views/dashbord/education.php');


                }
            }
        }
    
       
    }

    // delete registration
    public function deleteregistration() {
        
    
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

    // Méthode pour récupérer tous les enregistrements
    public function getAllRegistrations() {
        $registrations = $this->registration_service->findAll();
        if ($registrations) {
            return json_encode($registrations);
        } else {
            return json_encode(['error' => 'No registrations found']);
        }
    }
    public function getAllRegistrationsBySession($section_id) {
        $registrations = $this->registration_service->findRegistrationBySessionId($section_id);
        if ($registrations) {
            // echo '<pre>';
            // print_r($registrations);
            // echo '</pre>';
            return json_encode($registrations);
        } else {
            return json_encode(['error' => 'No registrations found']);
        }
    }
    public function getAllRegistrationsByFinishSession($section_id) {
        $registrations = $this->registration_service->findRegistrationBySessionId($section_id);
        if ($registrations) {
            return json_encode($registrations);
        } else {
            return json_encode(['error' => 'No registrations found']);
        }
    }
    // etudiant session terminé
    public function getAllRegistrationForFinishSession($section_id) {
        $registrations = $this->registration_service->findRegistrationByFinishSessionId($section_id);
        if ($registrations) {
            return json_encode($registrations);
        } else {
            return json_encode(['error' => 'No registrations found']);
        }
    }

    // public function studentRegisterBySession($section_id) {

    //   $student_register_by_session = $this->registration_service->studentRegisterBySession($section_id);
    //     if($student_register_by_session) {
    //         // print_r($student_register_by_session);
    //        return json_encode($student_register_by_session);
    //     }else {
    //         return json_encode(['error' => 'error']);
    //     }
    // }


    public function findNewProgramForStudent($section_id) {
        // $registration = $this->registration_service-> findById($id);
        $new_program = $this->registration_service->findNewProgramForStudent($section_id);
        if($new_program) {
            return json_encode($new_program);
        }else {
            return json_encode(['error' => 'error']);
        }
    }
    
}




$registration_controller = new registrationController();
if(isset($_POST['addRegistration'])) {
    $registration_controller->createRegistration();
}
if(isset($_POST['updateRegistration'])) {
    $registration_controller->updateRegistration();

}

$json_registration = $registration_controller->getAllRegistrations();
$registrations = json_decode($json_registration, true);


