<?php
class Tuition
{
    private $id;
    private $created_by;
    private $last_modified_by;
    private $program_id;
    private $section_id;
    // private $program;
    // private $level_name;
    private $amount;
    private $created_at;
    private $deleted;
    private $created_by_username;
    private $last_modified_by_username;



    public function __construct($id, $created_by, $last_modified_by, $program_id, $section_id,$amount,$created_at, $deleted)
    {
        $this->id = $id;
        $this->created_by = $created_by;
        $this->last_modified_by = $last_modified_by;
        $this->program_id = $program_id;
        $this->section_id = $section_id;
        $this->amount = $amount;
        $this->created_at = $created_at;
        $this->deleted = $deleted;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getSectionId()
    {
        return $this->section_id;
    }
    public function getProgramId()
    {
        return $this->program_id;
    }
    // public function getProgram()
    // {
    //     return $this->program;
    // }
    // public function getLevelName() {
    //     return $this->level_name;
    // }
    public function getAmount()
    {
        return $this->amount;
    }
    public function getCreatedBy()
    {
        return $this->created_by;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getLastModifiedBy()
    {
        return $this->last_modified_by;
    }
    public function getDeleted()
    {
        return $this->deleted;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }
    public function setSectionId($section_id)
    {
        return $this->section_id = $section_id;
    }
    // public function setProgram($program)
    // {
    //     return $this->program = $program;
    // }
    // public function setLevelName($level_name) {
    //     return $this->level_name = $level_name;
    // }
    public function setAmount($amount)
    {
        return $this->amount = $amount;
    }
    public function setProgramId($program_id)
    {
        return $this->program_id = $program_id;
    }
    public function setCreatedBy($created_by)
    {
        return $this->created_by = $created_by;
    }
    public function setLastModifiedBy($last_modified_by)
    {
        return $this->last_modified_by = $last_modified_by;
    }
    public function setCreatedAt($created_at)
    {
        return $this->created_at = $created_at;
    }
    public function setDeleted($deleted)
    {
        return $this->deleted = $deleted;
    }
    public function getCreatedByUsername(){
        return $this->created_by_username;
    }
    public function setCreatedByUsername($created_by_username){
        return $this->created_by_username = $created_by_username;
    }
    public function getLastModifiedByUsername() {
        return $this->last_modified_by_username;
    }
    public function setLastModifiedByUsername($last_modified_by_username) {
        return $this->last_modified_by_username = $last_modified_by_username;
    }
}
