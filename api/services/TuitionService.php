<?php
require_once("../repositories/TuitionRepository.php");

class TuitionService {
    private $tuition_repository;

    public function __construct($pdo) {
        $this->tuition_repository = new TuitionRepository($pdo);
    }

    public function createTuition($tuition) {
        return $this->tuition_repository->createTuition($tuition);
    }

    public function findById($id) {
        return $this->tuition_repository->findById($id);
    }

    public function updateTuition($tuition) {
        return $this->tuition_repository->updateTuition($tuition);
    }

    public function deleteTuition($id) {
        return $this->tuition_repository->deleteTuition($id);
    }

    public function findAll() {
        return $this->tuition_repository->findAll();
    }

  
}