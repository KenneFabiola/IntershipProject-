<?php
class Section {
    private $id;
    private $created_at;
    private $school_year;
    private $created_by;
    private $last_modified_by;
    private $delete;
    private $statut;

    public function __construct($id, $created_at,$school_year,$created_by,$last_modified_by,$delete,$statut) {
        $this->id = $id;
        $this->created_at = $created_at; 
        $this->school_year = $school_year;
        $this->created_by = $created_by;
        $this->last_modified_by = $last_modified_by;
        $this->delete = $delete;
        $this->statut = $statut;
        
    }

    public function getId() {
        return $this->id;
    }
    public function getCreatedBy() {
        return $this->created_by;
    }
    public function getLastModifiedBy(){
        return $this-> last_modified_by;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getSchoolYear() {
        return $this->school_year;
    }
    public function getDelete() {
        return $this->delete;
    }
    public function getStatut() {
        return $this->statut;
    }
    public function setId() {
        return $this->id;
    }
    public function setCreatedAt($created_at) {
        return $this->created_at;
    }
    public function setSchoolYear($scool_year) {
        return $this->school_year;
    }
    public function setDelete($delete) {
        return $this->delete;
    }
    public function setStatut($statut) {
        return $this->statut;
    }
}

?>