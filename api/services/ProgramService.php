<?php
require_once("../repositories/ProgramRepository.php");

class ProgramService {
    private $program_repository;

    public function __construct($pdo) {
        $this->program_repository = new ProgramRepository($pdo);
    }

    public function createProgram($student) {
        return $this->program_repository->createProgram($student);
    }

    public function findById($id) {
        return $this->program_repository->findById($id);
    }

    public function updateProgram($student) {
        return $this->program_repository->updateProgram($student);
    }

    public function deleteProgram($id) {
        return $this->program_repository->deleteProgram($id);
    }

    public function findAll() {
        return $this->program_repository->findAll();
    }

  
}