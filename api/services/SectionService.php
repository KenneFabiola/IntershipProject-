<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'SectionRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';


class SectionService {
    private $section_repository;
    private $user_repository;

    public function __construct($pdo) {
        $this->section_repository = new SectionRepository($pdo);
        $this->user_repository = new UserRepository($pdo);
    }

    public function createsection( Section $section) {
     
        $result = $this->section_repository->createsection($section);
        if (isset($result['success'])) {
            return $result['success'];
        } elseif (isset($result['error'])) {
            return ['error' => $result['error']];
        }
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