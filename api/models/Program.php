<?php
class Program{
    private $id;
    private $program_name;
    private $amount;
    private $duration;
    private $created_by;
    private $last_modified_by;
    private $created_at;
    private $deleted;

    private $created_by_name;
    private $last_modified_by_name;

    public function __construct( $id,$program_name,$amount,$duration,$created_by, $last_modified_by,$created_at,$deleted) {
        $this->id = $id;
        $this->program_name = $program_name; 
        $this->amount = $amount;
        $this->duration = $duration;
        $this->created_by = $created_by;
        $this->last_modified_by =  $last_modified_by;
        $this->created_at = $created_at;
        $this->deleted = $deleted;
        $this->created_by_name= null;
        $this->last_modified_by_name = null;
        
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
    public function getAmount() {
        return $this->amount;
    }
    public function setAmount($amount) {
        return $this->amount = $amount;
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
    public function getCreatedByName(){
        return $this ->created_by_name;
    }
    public function setCreatedByName($created_by_name){
        return $this ->created_by_name= $created_by_name;
    }
    public function getLastModifiedByName(){
        return $this ->last_modified_by_name;
    }
    
    public function setLastModifiedByName($last_modified_by_name){
        return $this ->last_modified_by_name = $last_modified_by_name;
    }
    
    
    

    



  } 

?>