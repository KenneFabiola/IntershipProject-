<?php
require_once("../repositories/SectionRepository.php");

class SectionService {
    private $section_repository;

    public function __construct($pdo) {
        $this->section_repository = new SectionRepository($pdo);
    }

    public function createsection($student) {
        return $this->section_repository->createsection($student);
    }

    public function findById($id) {
        return $this->section_repository->findById($id);
    }

    public function updateSection($student) {
        return $this->section_repository->updateSection($student);
    }

    public function deletesection($id) {
        return $this->section_repository->deleteSection($id);
    }

    public function findAll() {
        return $this->section_repository->findAll();
    }

  
}