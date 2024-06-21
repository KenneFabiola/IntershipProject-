<?php
require_once('../../Database.php');
require_once("..\models\Registration.php");
class RegistrationRepository{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of user
    public function createregistration(Registration $registration)
    {
        $sql = "INSERT INTO registrations (student_id,section_id,program_id,created_by,last_modified_by,created_at,deleted) VALUES (:student_id,:section_id,:program_id,:created_by,:last_modified_by:,:created_at,:deleted)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':student_id',$registration->getStudentId());
        $stmt->bindValue(':section_id', $registration->getSectionId());
        $stmt->bindValue(':program_id', $registration->getProgramId());
        $stmt->bindValue(':created_by',$registration->getCreatedBy());
        $stmt->bindValue(':last_modified_by',$registration->getLastModifiedBy());
        $stmt->bindValue(':created_at',$registration->getCreatedAt());
        $stmt->bindValue(':deleted',$registration->getDeleted());

        if ($stmt->execute()) {
            $registration->setId($this->pdo->lastInsertId());
            return $registration;
        }
        return null;
        

}
/**
 * find registration by their id 
 *
 * @param int $id
 * @return registration|null
 */
public function findById($id)
{
    try {
    $sql = 'SELECT * FROM registrations WHERE id = :id AND deleted = 0';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id'=> $id]);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return new Registration(
            $result['id'],
            $result['student_id'],
            $result['section_id'],
            $result['program_id'],
            $result['created_by'],
            $result['last_modified_by'],
            $result['created_at'],
            $result['deleted'],
           

        );

        echo ( $result['id'] . " " . $result['student_id']." ". "<br>");
       
    }
    return null;
}catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}
/**
 * find registration who haven't deleted so who deleted= false
 *
 * @return array
 */
public function findAll(){
    try {
        $stmt = $this->pdo->prepare('SELECT * FROM registrations WHERE deleted=false');
        $stmt->execute();
        $registration =[];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
            $registration = new Registration(
                $row['id'],
                $row['student_id'],
                $row['section_id'],
                $row['program_id'],
                $row['created_by'],
                $row['last_modified_by'],
                $row['created_at'],
                $row['deleted'],
            );
            echo ( $row['id'] . " " . $row['student_id']." ". "<br>");
    
        }
        return $registration;


    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
}


/**
 * update registration
 *
 * @param int $id
 * @return $registration
 */
 public function updateRegistration(Registration $registration)
 {
     try {
          $sql = 'UPDATE registrations SET 
            student_id = :student_id
            section_id = :section_id,
            program_id = :program_id,
            created_by = :created_by, 
            last_modified_by = :last_modified_by,
            created_at = :created_at,
            deleted = :deleted WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $registration->getId());
         $stmt->bindValue(':student_id',$registration->getStudentId());
         $stmt->bindValue(':section_id', $registration->getSectionId());
         $stmt->bindValue(':program_id', $registration->getProgramId());
         $stmt->bindValue(':created_by',$registration->getCreatedBy());
         $stmt->bindValue(':last_modified_by',$registration->getLastModifiedBy());
         $stmt->bindValue(':created_at',$registration->getCreatedAt());
         $stmt->bindValue(':deleted',$registration->getDeleted());
 

         if ($stmt->execute()) {
             return $registration;
         }
         return null;
     } catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
 }

 /**
  * delete registration
  *@param  int $id
  *@return bool

  */
  public function deleteRegistration($id){
    try{
        $sql = 'UPDATE registrations SET deleted = 1 WHERE id =:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id,);
        return $stmt->execute();
    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
  }

 
}