<?php
class Program{
    private $id;
    private $program_name;
    private $level_name;
    private $descriptive;
    private $duration;
    private $created_by;
    private $last_modified_by;
    private $created_at;
    private $deleted;
    private $availabity;


    public function __construct( $id,$program_name,$level_name,$descriptive,$duration,$created_by, $last_modified_by,$created_at,$deleted,$availabity) {
        $this->id = $id;
        $this->program_name = $program_name; 
        $this->level_name = $level_name;
        $this->descriptive = $descriptive;
        $this->duration = $duration;
        $this->created_by = $created_by;
        $this->last_modified_by =  $last_modified_by;
        $this->created_at = $created_at;
        $this->deleted = $deleted;
        $this->availabity = $availabity;
        
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        return $this->id = $id;
    }
    public function getProgramName() {
        return $this->program_name;
    }
      
    public function getLevelName() {
        return $this->level_name;
    }
      
    public function setProgramName($program_name) {
        return $this->program_name= $program_name;
    }
    public function setLevelName($level_name) {
        return $this->level_name = $level_name;
    }
    public function getDescriptive() {
        return $this->descriptive;
    }
    public function setDescriptive($descriptive) {
        return $this->descriptive = $descriptive;
    }
    public function getDuration() {
        return $this->duration;
    }
   
    public function setDuration($duration) {
        return $this->duration = $duration;
    }
   
    public function getCreatedBy() {
        return $this->created_by;
    }
    public function setCreatedBy($created_by) {
        return $this->created_by = $created_by;
    }
    public function getLastModifiedBy() {
        return $this->last_modified_by;
    }
    public function setLastModifiedBy( $last_modified_by) {
        return $this->last_modified_by = $last_modified_by;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getAvailability() {
        return $this->availabity;
    }
    public function setAvailability($availabity) {
        return $this->availabity = $availabity;
    }

    public function setCreayedAt($created_at) {
        return $this->created_at =$created_at;
    }
    public function getDeleted() {
        return $this->deleted;
    }
    public function setDeleted($deleted) {
        return $this->deleted = $deleted;
    }
 
    
  } 

?>