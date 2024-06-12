<?php
require_once("../api\models\Student.php");
class Studentreposity{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of user
    public function createStudent(Student $student)
    {
        $sql = "INSERT INTO users (username,first_name,last_name,email,pwd,program,created_by,last_modified_by,created_at) VALUES (:username, :first_name, :last_name, :email,:pwd,:program,:created_by,:last_modified_by,:created_at)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':username', $student->getUsername());
        $stmt->bindValue(':first_name', $student->getFirstName());
        $stmt->bindValue(':last_name', $student->getLastName());
        $stmt->bindValue(':email', $student->getEmail());
        $stmt->bindValue(':pwd',$student->getPwd());
        $stmt->bindValue(':program',$student->getProgram());
        $stmt->bindValue(':created_by',$student->getCreatedBy());
        $stmt->bindValue(':last_modified_by',$student->getLastModifiedBy());
        $stmt->bindValue(':created_at',$student->getCreatedAt());

        if ($stmt->execute()) {
            $student->setId($this->pdo->lastInsertId());
            return $student;
        }
        return null;
        

}
}