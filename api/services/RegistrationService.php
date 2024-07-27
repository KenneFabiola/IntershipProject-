<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'RegistrationRepository.php';


class RegistrationService {
    private $registration_repository;

    public function __construct() {
        $this->registration_repository = new RegistrationRepository();
    }

    public function createRegistration($registration) {
        return $this->registration_repository->createRegistration($registration);
    }

    public function findById($id) {
        return $this->registration_repository->findById($id);
    }

    public function updateregistration($registration) {
        return $this->registration_repository->updateRegistration($registration);
    }

    public function deleteRegistration($id) {
        return $this->registration_repository->deleteRegistration($id);
    }

    public function findAll() {
        return $this->registration_repository->findAll();
    }
    public function findRegistrationBySessionId($section_id) {
        return $this->registration_repository->findSessionById($section_id);
           
    }
    public function findRegistrationByFinishSessionId($section_id) {
        return $this->registration_repository->findRegistrationForFinishSession($section_id);
           
    }
    // probleme ici
    public function studentRegisterBySession($section_id) {
        return $this->registration_repository->studentRegisterBySession($section_id);
    }


    public function findNewProgramForStudent($section_id) {
        return $this->registration_repository->findNewProgramForStudent($section_id);

    }
  
}