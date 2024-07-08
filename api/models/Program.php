<?php
class Program{
    private $id;
    private $program_name;
    private $descriptive;
    private $duration;
    private $created_by;
    private $last_modified_by;
    private $created_at;
    private $deleted;

    private $created_by_username;
    private $last_modified_by_username;

    public function __construct( $id,$program_name,$descriptive,$duration,$created_by, $last_modified_by,$created_at,$deleted) {
        $this->id = $id;
        $this->program_name = $program_name; 
        $this->descriptive = $descriptive;
        $this->duration = $duration;
        $this->created_by = $created_by;
        $this->last_modified_by =  $last_modified_by;
        $this->created_at = $created_at;
        $this->deleted = $deleted;
        // $this->created_by_name= null;
        // $this->last_modified_by_name = null;
        
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
      
    public function setProgramName($program_name) {
        return $this->program_name= $program_name;
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
    public function setCreayedAt($created_at) {
        return $this->created_at =$created_at;
    }
    public function getDeleted() {
        return $this->deleted;
    }
    public function setDeleted($deleted) {
        return $this->deleted = $deleted;
    }
    public function getCreatedByUserName(){
        return $this ->created_by_username;
    }
    public function setCreatedByName($created_by_username){
        return $this ->created_by_username= $created_by_username;
    }
    public function getLastModifiedByUserName(){
        return $this ->last_modified_by_username;
    }
    
    public function setLastModifiedByName($last_modified_by_name){
        return $this ->last_modified_by_username = $last_modified_by_name;
    }
    
    
    

    



  } 

?>