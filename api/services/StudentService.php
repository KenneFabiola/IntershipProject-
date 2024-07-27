<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'StudentRepository.php';


class studentService {
    private $student_repository;

    public function __construct() {
        $this->student_repository = new StudentRepository();
    }

    public function createStudent($student)
    {
        return $this->student_repository->createStudent($student);
    
    }
    

    public function findById($id) {
        return $this->student_repository->findById($id);
    }

    public function updateStudent($student) {
      return $this->student_repository->updateStudent($student);
    }

    public function deleteStudent($id) {
        return $this->student_repository->deleteStudent($id);
    }

    public function findAll() {
        return $this->student_repository->findAllStudent();
    }
    public function findAllRegisterStudent() {
        return $this->student_repository->findAllRegisterStudent();
    }
    public function findAllUnregisterStudent() {
        return $this->student_repository->findAllUnregisterStudent();
    }

    public function createAccount($id,$user) {
        return $this->student_repository->createAccount($id,$user);

    }
    public function disableAccount($id) {
        return $this->student_repository->disableAccount($id);

    }

  
}