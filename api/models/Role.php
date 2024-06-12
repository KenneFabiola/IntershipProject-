<?php
class Role
{
    private $id;
    private $role_name;
    private $description;

    public function __construct($id, $role_name, $description)
    {
        $this->id = $id;
        $this->role_name = $role_name;
        $this->description = $description;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getRoleByName()
    {
        return $this->role_name;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription()
    {
        return $this->description;
    }
    public function setRoleName()
    {
        return $this->role_name;
    }
    public function setId($id)
    {
        return $this->id;
    }
}
