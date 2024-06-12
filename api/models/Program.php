<?php
class Program{
    private $id;
    private $name;
    private $period;
    private $amount;
    private $createdBy;
    private $lastModifiedBy;

    public function __construct( $id, $name, $amount,$createdBy,$lastModifiedBy,$period) {
        $this->id = $id;
        $this->name = $name; 
        $this->period = $period;
        $this->amount = $amount;
        $this->lastModifiedBy;
        $this->createdBy = $createdBy;
        $this->lastModifiedBy = $lastModifiedBy;
        
    }

    public function getId() {
        return $this->id;
    }
    public function getLastModifiedBy() {
        return $this->lastModifiedBy;
    }
    public function getName() {
        return $this->name;
    }
    public function getPeriod() {
        return $this->period;
    }
    public function getCreatedBy() {
        return $this->createdBy;
    }
    public function getAmount() {
        return $this->amount;
    }
    public function setName($name) {
        return $this->name;
    }
    public function setPeriod($period) {
        return $this->period;
    }

    



  } 

?>