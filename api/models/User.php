<?php
class User
{
    private $id;
    private $username;
    private $first_name;
    private $last_name;
    private $email;
    private $pwd;
    private $deleted;
    private $role_id;


    public function __construct($id, $username, $first_name, $last_name, $email, $pwd,$deleted = 0,$role_id)
    {


        $this->id = $id;
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->deleted = $deleted;
        $this->role_id = $role_id;
    }


    public function getId()
    {
        return $this->id;
    }
   
    public function getLastName()
    {
        return $this->last_name;
    }
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPwd()
    {
        return $this->pwd;
    }
    public function getDeleted(){
        return $this->deleted;
    }
    public function getRoleId()
    {
        return $this->role_id;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }
    public function setUsername($username)
    {
        return $this->username = $username;
    }
    public function setFirstName($first_name)
    {
        return $this->first_name = $first_name;
    }
    public function setLastName($last_name)
    {
        return $this->last_name = $last_name ;
    }
    public function setEmail($email)
    {
        return $this->email = $email;
    }
    public function setPwd($pwd)
    {
        return $this->pwd = $pwd;
    }
    public function setDeleted($deleted){
        return $this->deleted = $deleted;
    }
    public function setRoleId($role_id)
    {
        return $this->role_id = $role_id;
    }
}
