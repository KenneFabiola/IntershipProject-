<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'SectionRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';


class SectionService {
    private $section_repository;
    private $user_repository;

    public function __construct() {
        $this->section_repository = new SectionRepository();
        $this->user_repository = new UserRepository();
    }

    public function createsection( Section $section) {
     
        return $this->section_repository->createsection($section);
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

    public function findAllSection() {
        return $this->section_repository->findAllSection();
    }
    public function finishSection($id) {
        return $this->section_repository->finishSection($id);
    }
   
    public function getInactiveSection() {
        return $this->section_repository->getInactiveSection();
    }
   
  
}