<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'RegistrationRepository.php';


class RegistrationService {
    private $registration_repository;

    public function __construct($pdo) {
        $this->registration_repository = new RegistrationRepository($pdo);
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

  
}