<?php
class Registration {
    private $id;
    private $student_id;
    private $section_id;
    private $program_id;
    private $created_by;
    private $last_modified_by;
    private $created_at;
    private $statut;
    private $deleted;
    
    public function __construct($id, $student_id,$section_id,$program_id,$created_by,$last_modified_by,$created_at,$statut,$deleted)
    {
        $this->id=$id;
        $this->student_id=$student_id;
        $this->section_id=$section_id;
        $this->program_id=$program_id;
        $this->created_by=$created_by;
        $this->last_modified_by=$last_modified_by;
        $this->created_at=$created_at;
        $this->statut=$statut;
        $this->deleted=$deleted;
    }

    public function getId(){
        return $this->id;
    }
    public function getStudentId(){
        return $this->student_id;
    }
    public function getSectionId(){
        return $this->section_id;
    }
    public function getProgramId(){
        return $this->program_id;
    }
    public function getCreatedBy(){
        return $this->created_by;
    }
    public function getLastModifiedBy(){
        return $this->last_modified_by;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getStatut() {
        return $this->statut;
    }
    public function getDeleted() {
        return $this->deleted;
    }
    
    public function setId($id){
        return $this->id = $id;
    }
    public function setStudentId($student_id){
        return $this->student_id = $student_id;
    }
    public function setSectionId($section_id){
        return $this->section_id = $section_id;
    }
    public function setProgramId($program_id){
        return $this->program_id = $program_id;
    }
    public function setCreatedBy($created_by){
        return $this->created_by;
    }
    public function setLastModifiedBy($last_modified_by){
        return $this->last_modified_by = $last_modified_by;
    }
    public function setCreatedAt($created_at) {
        return $this->created_at = $created_at;
    }
    public function setStatut($statut) {
        return $this->statut = $statut;
    }
    public function setDeleted($deleted) {
        return $this->deleted = $deleted;
    }
    


}
?>