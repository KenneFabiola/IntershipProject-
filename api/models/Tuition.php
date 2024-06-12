<?php
class Tuition
 {
    private $id;
    private $program;
    private $fees;
    private $year;
    private $sectionId;

    public function __construct($id,$program, $year, $fees,$sectionId) {
        $this->id = $id;
        $this->program = $program; 
        $this->fees = $fees;
        $this->year = $year;  
        $this->sectionId = $sectionId;       
    }

  

public function getId() {
    return $this->id;
}
public function getYear() {
    return $this->year;
}
public function getProgram() {
    return $this->program;
}
public function getFees() {
    return $this->fees;
}
public function getSectionId() {
    return $this->sectionId;
}
public function setFees() {
    return $this->fees;
}
public function setYear() {
    return $this->year;
}

}
?>