<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'TuitionRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'ProgramRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'SectionRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';


class TuitionService {
    private $tuition_repository;
    private $program_repository;
    private $section_repository;
    private $user_repository;

    public function __construct($pdo) {
        $this->tuition_repository = new TuitionRepository($pdo);
        $this->program_repository = new ProgramRepository($pdo);
        $this->section_repository = new SectionRepository($pdo);
        $this->user_repository = new UserRepository($pdo);
    }

    public function createTuition(Tuition $tuition) {
        if($this->section_repository->checkActiveSection($tuition->getSectionId())) {
            return $this->tuition_repository->createTuition($tuition);
            if (isset($result['success'])) {
                return $result['success'];
            } elseif (isset($result['error'])) {
                return ['error' => $result['error']];
            }
        }
    
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

    public function findAllTuition() {
        return $this->tuition_repository->findAllTuition();
    }
   

  
}