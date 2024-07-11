<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'ProgramRepository.php';


class ProgramService {
    private $program_repository;

    public function __construct() {
        $this->program_repository = new ProgramRepository();
        if(isset($result['success'])) {
            return $result['success'];
           }elseif (isset($result['error'])) {
            return $result['error'];
           }
    }

    public function createProgram($student) {
        return $this->program_repository->createProgram($student);
    }

    public function findById($id) {
        return $this->program_repository->findById($id);
    }

    public function updateProgram($program) {
        return $this->program_repository->updateProgram($program);
    }

    public function deleteProgram($id) {
        return $this->program_repository->deleteProgram($id);
    }

    public function findAllProgram() {
        return $this->program_repository->findAllProgram();
    }
    public function findProgramName() {
        return $this->program_repository->findProgramName();
    }

  
}