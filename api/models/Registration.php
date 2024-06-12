<?php
class Registration {
    private $id;
    private $createdAt;
    private $studentId;
    private $createdBy;
    private $lastModifiedBy;
    private $sectionId;
    private $programId;

    public function __construct($id, $createdAt, $studentId,$createdBy,$lastModifiedBy,$sectionId,$programId)
    {
        $this->id=$id;
        $this->createdAt=$createdAt;
    }

    public function getId(){
        return $this->id;
    }
    public function getCreatedAt(){
        return $this->createdAt;
    }
    public function getStudentId(){
        return $this->studentId;
    }
    public function getCreatedBy(){
        return $this->createdBy;
    }
    public function getLastModifiedBy(){
        return $this->lastModifiedBy;
    }
    public function getSectionId(){
        return $this->sectionId;
    }

    public function getProgramId(){
        return $this->programId;
    }

}
?>