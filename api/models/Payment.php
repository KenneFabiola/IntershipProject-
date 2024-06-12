<?php
class Payment {
    private $id;
    private $date;
    private $amount;
    private $createdBy;
    private $lastModifiedBy;
    private $deleteBy;
    private $tuitionId;
    private $registrationId;

    public function __construct($date, $amount,$id,$createdBy,$lastModifiedBy,$deleteBy,$tuitionId,$registrationId) {
       
        $this->id = $id;
        $this->date = $date;
        $this->amount = $amount;
        $this->createdBy = $createdBy;
        $this->lastModifiedBy = $lastModifiedBy;
        $this->deleteBy = $deleteBy;
        $this->tuitionId = $tuitionId;
        $this->registrationId = $registrationId;

        
    }
    public function getId() {
        return $this->id;
    }
    public function getDate() {
        return $this->date;
    }
    public function getAmount() {
        return $this->amount;
    }
    public function getCreatedby() {
        return $this->createdBy;
    }
    public function getLastModifiedBy() {
        return $this->lastModifiedBy;
    }
    public function getDeleteby() {
        return $this->deleteBy;
    }
    public function getTuitionId(){
        return $this->tuitionId;
    }
    public function getProgram_id(){
        return $this->registrationId;
    }

    public function setamount($amount) {
        return $this->amount;
    }
   
  

  } 

?>