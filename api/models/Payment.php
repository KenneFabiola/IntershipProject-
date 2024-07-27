<?php
class Payment {
    private $id;
    private $amount;
    private $statut;
    private $created_at;
    private $created_by;
    private $last_modified_by;
    private $deleted;
    private $registration_id;

    public function __construct($id,$amount,$statut,$created_at,$created_by,$last_modified_by,$deleted,$registration_id) {
       
        $this->id = $id;
        $this->created_at = $created_at;
        $this->amount = $amount;
        $this->statut = $statut;
        $this->created_by = $created_by;
        $this->last_modified_by = $last_modified_by;
        $this->deleted = $deleted;
        $this->registration_id = $registration_id;

        
    }
    public function getId() {
        return $this->id;
    }
    
    public function getAmount() {
        return $this->amount;
    }
    public function getStatut() {
        return $this->statut;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getCreatedBy()
    {
        return $this->created_by;
    }
   
    public function getLastModifiedBy()
    {
        return $this->last_modified_by;
    }
    public function getDeleted()
    {
        return $this->deleted;
    }
    public function getRegistrationId(){
        return $this->registration_id;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }
    public function setAmount($amount) {
        return $this->amount = $amount;
    }
    public function setStatut($statut) {
        return $this->statut = $statut;
    }
    public function setCreatedAt($created_at)
    {
        return $this->created_at = $created_at;
    }
    public function setCreatedBy($created_by)
    {
        return $this->created_by = $created_by;
    }
    public function setLastModifiedBy($last_modified_by)
    {
        return $this->last_modified_by = $last_modified_by;
    }
    public function setDeleted($deleted)
    {
        return $this->deleted = $deleted;
    }
    public function setRegistrationId($registration_id){
        return $this->registration_id = $registration_id;
    }
   
  

  } 

?>