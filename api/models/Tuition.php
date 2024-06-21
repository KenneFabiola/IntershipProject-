<?php
class Tuition
{
    private $id;
    private $created_by;
    private $last_modified_by;
    private $program_id;
    private $section_id;
    private $program;
    private $created_at;
    private $deleted;



    public function __construct($id, $created_by, $last_modified_by, $program_id, $section_id, $program, $created_at, $deleted)
    {
        $this->id = $id;
        $this->created_by = $created_by;
        $this->last_modified_by = $last_modified_by;
        $this->program_id = $program_id;
        $this->section_id = $section_id;
        $this->program = $program;
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
    public function getProgram()
    {
        return $this->program;
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
    public function setProgram($program)
    {
        return $this->program = $program;
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
}
