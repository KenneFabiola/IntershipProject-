<?php
require_once('../../Database.php');
require_once("..\models\Student.php");
class StudentRepository{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // create student
    public function createStudent(Student $student)
    {
        $hashed_pwd = password_hash($student->getPwd(), PASSWORD_BCRYPT);
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
            return $student;
        }
        return null;
        

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
            $result['program'],
            $result['created_by'],
            $result['last_modified_by'],
            $result['created_at'],
            $result['deleted']
        );

        echo ( $result['id'] . " " . $result['username'] . " ". $result['first_name']. " ". $result['last_name']." ".$result['email']." ". $result['pwd']." ". $result['program']." ". "<br>");
       
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
        $stmt = $this->pdo->prepare('SELECT * FROM students WHERE deleted=false');
        $stmt->execute();
        $student =[];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
            $student = new Student(
                $row['id'],
                $row['created_by'],
                $row['last_modified_by'],
                $row['username'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['program'],
                $row['pwd'],
                $row['created_at'],
                $row['deleted']
            );
            echo ( $row['id'] . " " . $row['username'] . " ". $row['first_name']. " ". $row['last_name']." ".$row['email']." ". $row['pwd']." ". $row['program']." ". "<br>");
         
        }
        return $student;


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

  /**
   * find username by id
   */
//  public function findUsernameUserById($id){
//     try{
//         $sql = 'SELECT username FROM users WHERE id = :id';
//         $stmt = $this->pdo->prepare($sql);
//         $stmt->execute(['id' => $id]);
//         $result = $stmt->fetch(PDO::FETCH_ASSOC);

//         if($result){
//             return $result['username'];

//         }
//         return null;

//     }catch (PDOException $e) {
//          echo 'PDOExecption:' . $e->getMessage();
//      }

// }
}