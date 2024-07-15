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
        try {
            $verify = "SELECT COUNT(*) FROM students WHERE email = :email AND username = :username AND deleted = 0";
    
            $verifyStatement = $this->pdo->prepare($verify);
            $verifyStatement->bindValue(':username', $student->getUsername());
            $verifyStatement->bindValue(':email', $student->getEmail());
            $verifyStatement->execute();
    
            if ($verifyStatement->fetchColumn() > 0) {
                return ['error' => 'Student already exists'];
            }
    
            $hashed_pwd = password_hash($student->getPwd(), PASSWORD_DEFAULT);
    
            $sql = "INSERT INTO students (created_by, last_modified_by, username, first_name, last_name, email, pwd, created_at, deleted)
                    VALUES (:created_by, :last_modified_by, :username, :first_name, :last_name, :email, :pwd, :created_at, :deleted)";
    
            $stmt = $this->pdo->prepare($sql);
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
                $student->setId($this->pdo->lastInsertId());
                return ['success' => $student];
            }
    
            return ['error' => 'Failed to create student'];
        } catch (PDOException $e) {
            error_log('PDOException: ' . $e->getMessage());
            throw new Exception('Error creating student: ' . $e->getMessage());
        }
    }
     
/**
 * find student by their id 
 *
 * @param int $id
 * @return Student|null
 */
public function findById($id)
{
    try {
    $sql = 'SELECT * FROM students WHERE id = :id AND deleted = 0';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id'=> $id]);
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
public function findAllStudent()
{
    try {
        $sql = "SELECT  s.*,
                u1.username AS created_by_username,
                u2.username AS last_modified_by_username
                FROM students s
                LEFT JOIN users u1 ON s.created_by = u1.id
                LEFT JOIN users u2 ON s.last_modified_by = u2.id
                WHERE s.deleted = false
                ORDER BY s.id";
        $stmt = $this->pdo->query($sql);
        $students = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $students[] = $row;
        }

        return $students;
    } catch (PDOException $e) {
        echo 'PDOExecption:' . $e->getMessage();
        return [];
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
        $verify = "SELECT COUNT(*) FROM students WHERE email = :email AND username = :username AND deleted = 0";
    
        $verifyStatement = $this->pdo->prepare($verify);
        $verifyStatement->bindValue(':username', $student->getUsername());
        $verifyStatement->bindValue(':email', $student->getEmail());
        $verifyStatement->execute();

        if ($verifyStatement->fetchColumn() > 0) {
            return ['error' => 'Student already exists'];
        }

            $sql = 'UPDATE students SET 
                username = :username,
                first_name = :first_name,
                last_name = :last_name,
                email = :email,       
                last_modified_by = :last_modified_by
                WHERE id = :id';

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $student->getId());
            $stmt->bindValue(':username', $student->getUsername());
            $stmt->bindValue(':first_name', $student->getFirstName());
            $stmt->bindValue(':last_name', $student->getLastName());
            $stmt->bindValue(':email', $student->getEmail());
            $stmt->bindValue(':last_modified_by', $student->getLastModifiedBy());


         if ($stmt->execute()) {
            return ['success' => $student];
            }
    
            return ['error' => 'Failed to update student'];
     } catch (PDOException $e) {
        error_log('PDOException: ' . $e->getMessage());
        throw new Exception('Error updating student: ' . $e->getMessage());
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


 
}

