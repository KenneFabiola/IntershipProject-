<?php
// session_start();
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Student.php' ;
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'User.php' ;


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
                return 3;
            }
    
    
            $sql = "INSERT INTO students (created_by, last_modified_by, username, first_name, last_name, email, created_at, deleted)
                    VALUES (:created_by, :last_modified_by, :username, :first_name, :last_name, :email, :created_at, :deleted)";
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':username', $student->getUsername());
            $stmt->bindValue(':first_name', $student->getFirstName());
            $stmt->bindValue(':last_name', $student->getLastName());
            $stmt->bindValue(':email', $student->getEmail());
            $stmt->bindValue(':created_by', $student->getCreatedBy());
            $stmt->bindValue(':last_modified_by', $student->getLastModifiedBy());
            $stmt->bindValue(':created_at', $student->getCreatedAt());
            $stmt->bindValue(':deleted', $student->getDeleted());
    
            if ($stmt->execute()) {
                $student->setId($this->pdo->lastInsertId());
                return 1;
            }
    
            return 0;
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
            $result['created_by'],
            $result['last_modified_by'],
            $result['created_at'],
            $result['statut'],
            $result['registration'],
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
                ORDER BY s.username ASC";
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

public function findAllUnregisterStudent()
{
    try {
        $sql = "SELECT  s.*,
                u1.username AS created_by_username,
                u2.username AS last_modified_by_username
                FROM students s
                LEFT JOIN users u1 ON s.created_by = u1.id
                LEFT JOIN users u2 ON s.last_modified_by = u2.id
                WHERE s.deleted = false AND s.registration = false
                ORDER BY s.username ASC";
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
public function findAllRegisterStudent()
{
    try {
        $sql = "SELECT  s.*,
                u1.username AS created_by_username,
                u2.username AS last_modified_by_username
                FROM students s
                LEFT JOIN users u1 ON s.created_by = u1.id
                LEFT JOIN users u2 ON s.last_modified_by = u2.id
                WHERE s.deleted = false AND s.registration = true
                ORDER BY s.username ASC";
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
            return 3;
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
            return 1;
            }
    
            return 0;
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






  /* create user account of student */

  public function createAccount($id,User $user) {

    try {
        $sql = 'SELECT statut FROM students WHERE id = :id';
        $stmt = $this ->pdo->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC); 

        if($result['statut'] == 'etudiant') {

            $verify = "SELECT COUNT(*) FROM users WHERE email = :email AND username = :username AND statut = 'actif' ";
            $stmtverify = $this->pdo->prepare($verify);
            $stmtverify->bindValue(':username', $user->getUsername());
            $stmtverify->bindValue(':email', $user->getEmail());
            $stmtverify->execute();

            if($stmtverify->fetchColumn() > 0) {
                return 12 ;
            }

            $sql_update = "UPDATE students SET statut = 'utilisateur' WHERE id = :id AND deleted = false ";
            $stmt_update = $this->pdo->prepare($sql_update);
            $stmt_update ->bindValue('id',$id);
            $stmt_update->execute();

            $find_password = $user->getPwd();
            $hashed_pwd = password_hash($find_password, PASSWORD_DEFAULT);

            $sql_user = "INSERT INTO users
            (username,first_name,last_name,email,pwd,role_id,deleted) 
            VALUES (:username, :first_name, :last_name, :email,:pwd,:role_id,:deleted)";
            $stmt = $this->pdo->prepare($sql_user);
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':first_name', $user->getFirstName());
            $stmt->bindValue(':last_name', $user->getLastName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':pwd', $hashed_pwd);
            $stmt->bindValue(':role_id', $user->getRoleId());
            $stmt->bindValue(':deleted', $user->getDeleted());
    
            if($stmt->execute() && $stmt_update->execute() ) {
                $user->setId($this->pdo->lastInsertId());
                return 1;
            }
            return 0;

            }

        }catch (PDOException $e) {
            echo 'PDOExecption:' . $e->getMessage();
        }
}


public function disableAccount($id) {
    try {
        $sql = 'SELECT statut FROM students WHERE id = :id';
        $stmt = $this ->pdo->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        print_r($result['statut']); 

        if($result['statut'] == 'utilisateur') {
                $sql_statut = "UPDATE students SET statut = 'etudiant' WHERE id = :id ";
                $stmt = $this->pdo->prepare($sql_statut);
                $stmt ->bindParam(':id',$id);
                $stmt->execute();
                echo '2';
                $select = "SELECT username, email FROM students WHERE id = :id AND deleted = false";
                $statment = $this->pdo->prepare($select);
                $statment->bindValue(':id',$id);
                $statment->execute();
                $result_username = $statment->fetch(PDO::FETCH_ASSOC);
                $username_student=($result_username['username']);
                $email_student = ($result_username['email']);

                $sql_find_student = "SELECT id FROM users WHERE username = :username AND email = :email";
                $stmt_find_student = $this->pdo->prepare($sql_find_student);
                $stmt_find_student->bindParam(':username',$username_student);
                $stmt_find_student->bindParam(':email',$email_student);

                $stmt_find_student->execute(); echo '2';
                $result_select = $stmt_find_student->fetch(PDO::FETCH_ASSOC); 
                $student_id_user = $result_select['id'];

                $sql_update = "UPDATE users SET statut = 'inactif' WHERE id = :id AND deleted = false ";
                $stmt_update = $this->pdo->prepare($sql_update);
                $stmt_update ->bindParam('id',$student_id_user);
                $stmt_update->execute();
                if($stmt->execute() && $stmt_update->execute()) {
                    return 1;
                } else {
                    return 0;
                }

            }

        }catch (PDOException $e) {
            echo 'PDOExecption:' . $e->getMessage();
        }
}
     



 
}

