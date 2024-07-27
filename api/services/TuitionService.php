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

    public function createTuition(Tuition $tuition, $id) {
        if($this->section_repository->checkActiveSection($tuition->getSectionId())) {
            return  $this->tuition_repository->createTuition($tuition,$id);
            
        }
    
    }

    public function findById($id) {
        return $this->tuition_repository->findById($id);
    }

    public function updateTuition($tuition) {
        if($this->section_repository->checkActiveSection($tuition->getSectionId())) {
            return $this->tuition_repository->updateTuition($tuition);
        }
        
    }

    public function deleteTuition($id) {
        return $this->tuition_repository->deleteTuition($id);
    }

    public function findAllTuition() {
        return $this->tuition_repository->findAllTuitions();
    }
    public function findTuitionBySectionId($section_id) {
        return $this->tuition_repository->findTuitionBySectionId($section_id);
    }

    public function findProgramBySession($section_id) {
        return $this->tuition_repository->findProgramBySession($section_id);

    }
   

  
}