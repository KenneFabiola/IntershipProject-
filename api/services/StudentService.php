<?php
require_once("../repositories/StudentRepository.php");

class studentService {
    private $student_repository;

    public function __construct($pdo) {
        $this->student_repository = new StudentRepository($pdo);
    }

    public function createStudent($student) {
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
        return $this->student_repository->findAll();
    }

  
}