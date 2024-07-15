<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'StudentRepository.php';


class studentService {
    private $student_repository;

    public function __construct() {
        $this->student_repository = new StudentRepository();
    }

    public function createStudent($student)
    {
        $result = $this->student_repository->createStudent($student);
    
        if (isset($result['error'])) {
            return $result['error'];
        } elseif (isset($result['success'])) {
            return $result['success'];
        }
    }
    

    public function findById($id) {
        return $this->student_repository->findById($id);
    }

    public function updateStudent($student) {
        $result = $this->student_repository->updateStudent($student);
        if (isset($result['error'])) {
            return $result['error'];
        } elseif (isset($result['success'])) {
            return $result['success'];
        }
    }

    public function deleteStudent($id) {
        return $this->student_repository->deleteStudent($id);
    }

    public function findAll() {
        return $this->student_repository->findAllStudent();
    }

  
}