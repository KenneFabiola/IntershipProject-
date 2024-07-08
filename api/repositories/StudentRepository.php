<?php
// session_start();
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Student.php' ;


class StudentRepository{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of user
    public function createStudent(Student $student)
    {
        try{
                $verify = "SELECT COUNT(*) FROM students WHERE email = :email AND username = :username ";
                $stmtverify = $this->pdo->prepare($verify);
                $stmtverify->bindValue(':username', $student->getUsername());
                $stmtverify->bindValue(':email', $student->getEmail());
                $stmtverify->execute();
                if($stmtverify->fetchColumn() > 0) {
                    return ['error' => 'Student already exist'];
                }
                $find_password = $student->getPwd();
                $hashed_pwd = password_hash($find_password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO students (username,first_name,last_name,email,pwd,program,created_by,last_modified_by,created_at,deleted) VALUES (:username, :first_name, :last_name, :email,:pwd,:program,:created_by,:last_modified_by,:created_at,:deleted)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':username', $student->getUsername());
                $stmt->bindValue(':first_name', $student->getFirstName());
                $stmt->bindValue(':last_name', $student->getLastName());
                $stmt->bindValue(':email', $student->getEmail());
                $stmt->bindValue(':pwd',$hashed_pwd);
                $stmt->bindValue(':program',$student->getProgram());
                $stmt->bindValue(':created_by',$student->getCreatedBy());
                $stmt->bindValue(':last_modified_by',$student->getLastModifiedBy());
                $stmt->bindValue(':created_at',$student->getCreatedAt());
                $stmt->bindValue(':deleted',$student->getDeleted());

                if ($stmt->execute()) {
                    $student->setId($this->pdo->lastInsertId());
                    return ['success' =>  $student];
                }
                return ['error' => 'failed'];
    }catch(PDOException $e){
        error_log('PDOExeception: ' .$e->getMessage());
          return null;
      }
        

}
/**
 * find student by their id 
 *
 * @param int $id
 * @return Student|null
 */
public function findById($student_id)
{
    try {
    $sql = 'SELECT * FROM students WHERE id = :id AND deleted = 0';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id'=> $student_id]);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return new Student(
            $result['id'],
            $result['username'],
            $result['first_name'],
            $result['last_name'],
            $result['email'],
            $result['pwd'],
            $result['program'],
            $result['created_by'],
            $result['last_modified_by'],
            $result['created_at'],
            $result['deleted']
        );

        
    }
    return null;
}catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}
/**
 * find student who haven't deleted so who deleted= false
 *
 * @return array
 */
public function findAll(){
    try {
        $stmt = $this->pdo->prepare('SELECT * FROM students WHERE deleted = false');
        $stmt->execute();
        $students =[];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
          
           $row['created_by_username'] = $this-> findUsernameUserById($row['created_by']);
           $row['last_modified_by_username'] = $this->findUsernameUserById($row['last_modified_by']);
           $students[] = $row;
        }
        return $students;


    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
}




/**
 * update student
 *
 * @param int $id
 * @return $student
 */
 public function updateStudent(Student $student)
 {
     try {
         $hashed_pwd = password_hash($student->getPwd(), PASSWORD_BCRYPT);
         $sql = 'UPDATE students SET 
            first_name =:first_name,
            last_name=:last_name,
            email=:email,
            pwd=:pwd,
            username=:username,
            program=program, 
            created_by=:created_by, 
            last_modified_by=:last_modified_by,
            created_at=:created_at,
            deleted=:deleted WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $student->getId());
         $stmt->bindValue(':username', $student->getUsername());
         $stmt->bindValue(':first_name', $student->getFirstName());
         $stmt->bindValue(':last_name', $student->getLastName());
         $stmt->bindValue(':email', $student->getEmail());
         $stmt->bindValue(':pwd', $hashed_pwd);
         $stmt->bindValue(':created_by', $student->getCreatedBy());
         $stmt->bindValue(':last_modified_by', $student->getLastModifiedBy());
         $stmt->bindValue(':created_at', $student->getCreatedAt());
         $stmt->bindValue(':deleted', $student->getDeleted());


         if ($stmt->execute()) {
             return $student;
         }
         return null;
     } catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
 }

 /**
  * delete student
  *@param  int $id
  *@return bool

  */
  public function deleteStudent($id){
    try{
        $sql = 'UPDATE students SET deleted = 1 WHERE id =:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id,);
        return $stmt->execute();
    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
  }

 

public function findByUsername($username) {
    try {
        $sql = 'SELECT * FROM students WHERE username = :username';
        $stmt = $this->pdo->prepare($sql);
        $stmt ->bindValue(':username',$username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
       

        if($result){
            return new Student(
                $result['id'],
                $result['username'],
                $result['first_name'],
                $result['last_name'],
                $result['email'],
                $result['pwd'],
                $result['program'],
                $result['created_by'],
                $result['last_modified_by'],
                $result['created_at'],
                $result['deleted']
               
            );

        }
        return null;

    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
         return null;
     }
}



/**
 * find Program
 
 */
public function  findProgram($id) {

    try {
        $sql = 'SELECT program_name FROM programs where id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindParam(':id',$id);
        $stmt->execute();
        $result= $stmt->fetch(PDO::FETCH_ASSOC);

        if($result) {
            return $result['program_name'];
        }
        return null;
    } catch(PDOException $e) {
        echo 'PDOExecption:' .$e->getMessage();
        return null;
    }
}


 /**
   * find username by id
   */
  public function findUsernameUserById($id){
    try{
        $sql = 'SELECT username FROM users WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt ->bindParam(':id',$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
       

        if($result){
            return $result['username'];

        }
        return null;

    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
         return null;
     }

}

}

