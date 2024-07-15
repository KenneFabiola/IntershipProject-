<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'TuitionRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'SectionRepository.php';



class TuitionService {
    private $tuition_repository;
    private $section_repository;
 

    public function __construct() {
        $this->tuition_repository = new TuitionRepository();
        $this->section_repository = new SectionRepository();
        
    }

    public function createTuition(Tuition $tuition) {
        if($this->section_repository->checkActiveSection($tuition->getSectionId())) {
            $result =  $this->tuition_repository->createTuition($tuition);
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
        if($this->section_repository->checkActiveSection($tuition->getSectionId())) {
            $result =  $this->tuition_repository->updateTuition($tuition);
            if (isset($result['success'])) {
                return $result['success'];
            } elseif (isset($result['error'])) {
                return ['error' => $result['error']];
            }
        }
        
    }

    public function deleteTuition($id) {
        return $this->tuition_repository->deleteTuition($id);
    }

    public function findAllTuition() {
        return $this->tuition_repository->findAllTuitions();
    }
   

  
}