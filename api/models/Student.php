<?php
class Student{
  private $id;
  private $username;
  private $first_name;
  private $last_name;
  private $email;
  private $pwd;
  private $program;
  private $created_by;
  private $last_modified_by;
  private $created_at;
  private $delete;


  public function __construct($id,$username, $first_name,$last_name, $email,$pwd,$program,$created_by,$last_modified_by,$created_at,$delete) {
    $this->id = $id;
    $this->username = $username;
    $this->first_name = $first_name; 
    $this->last_name = $last_name; 
    $this->email = $email;
    $this->pwd = $pwd;  
    $this->program = $program;  
    $this->created_by = $created_by;  
    $this->last_modified_by = $last_modified_by;  
    $this->created_at = $created_at;  
    $this->delete = $delete;  
  }
  

public function getId() {
    return $this->id;
}
public function getUsername() {
    return $this->username;
}
public function getLastName() {
    return $this->last_name;
}
public function getFirstName() {
    return $this->first_name;
}
public function getEmail(){
    return $this->email;
}
public function getPwd() {
    return $this->pwd;
}
public function getProgram() {
    return $this->program;
}
public function getCreatedBy() {
    return $this->created_by;
}
public function getCreatedAt() {
    return $this->created_at;
}
public function getLastModifiedBy() {
    return $this->last_modified_by;
}
public function getdelete() {
    return $this->delete;
}
public function setId() {
    return $this->id;
}
public function setUsername() {
    return $this->username;
}
public function setLastName() {
    return $this->last_name;
}
public function setFirstName() {
    return $this->first_name;
}
public function setEmail() {
    return $this->email;
}
public function setPwd() {
    return $this->pwd;
}
public function setProgram() {
    return $this->program;
}
public function setCreatedBy() {
    return $this->last_modified_by;
}
public function setLastModifiedBy() {
    return $this->last_modified_by;
}
public function setCreatedAy() {
    return $this->created_at;
}
public function setdelete() {
    return $this->delete;
}


}
?>