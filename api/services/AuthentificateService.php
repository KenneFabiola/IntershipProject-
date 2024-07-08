<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'StudentRepository.php';



class AuthentificateService
{
    private $user_repository;
    private $student_repository;
 

    public function __construct($pdo)
    {
        $this->user_repository = new UserRepository($pdo);
        $this->student_repository = new StudentRepository($pdo);
   
       
    }

    public function login($username, $password)
    {

        // Find user by username
        $user = $this->user_repository->findByUsername($username);
       
        
       


        if ($user) {

           
            $hashed_password = $user->getPwd();
            
            // Check password
            if (password_verify($password, $hashed_password)) {

                json_decode('Authentification: Password verification successful');
                


                return $user;
            } 
        } else    
        $student= $this->student_repository->findByUsername($username);
    
        if ($student) {
            $hashed_password = $student->getPwd();
        
            // Check password
            if (password_verify($password, $hashed_password)) {

                return $student;
            } else {
                error_log('incorrect password');
            }
        } else{
            error_log('student not found');
        }
         return null;
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
    }



  
}



