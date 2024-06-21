<?php
require_once('../../Database.php');
require_once("..\models\Tuition.php");
class TuitionRepository{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of user
    public function createTuition(Tuition $tuition)
    {
        $sql = "INSERT INTO tuitions (created_by,last_modified_by,program_id,section_id,program,created_at,deleted) VALUES (:created_by,:last_modified_by:,:program_id,:section_id,:program,:created_at,:deleted)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':created_by',$tuition->getCreatedBy());
        $stmt->bindValue(':last_modified_by',$tuition->getLastModifiedBy());
        $stmt->bindValue(':program_id', $tuition->getProgramId());
        $stmt->bindValue(':section_id', $tuition->getSectionId());
        $stmt->bindValue(':program',$tuition->getProgram());
         $stmt->bindValue(':created_at',$tuition->getCreatedAt());
        $stmt->bindValue(':deleted',$tuition->getDeleted());

        if ($stmt->execute()) {
            $tuition->setId($this->pdo->lastInsertId());
            return $tuition;
        }
        return null;
        

}
/**
 * find tuition by their id 
 *
 * @param int $id
 * @return tuition|null
 */
public function findById($id)
{
    try {
    $sql = 'SELECT * FROM tuitions WHERE id = :id AND deleted = 0';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id'=> $id]);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return new tuition(
            $result['id'],
            $result['created_by'],
            $result['last_modified_by'],
            $result['program_id'],
            $result['section_id'],
            $result['program'],
            $result['created_at'],
            $result['deleted'],
           

        );

        echo ( $result['id'] . " " . $result['program']." ". "<br>");
       
    }
    return null;
}catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}
/**
 * find tuition who haven't deleted so who deleted= false
 *
 * @return array
 */
public function findAll(){
    try {
        $stmt = $this->pdo->prepare('SELECT * FROM tuitions WHERE deleted=false');
        $stmt->execute();
        $tuition =[];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
            $tuition = new tuition(
                $row['id'],
                $row['created_by'],
                $row['last_modified_by'],
                $row['program_id'],
                $row['section_id'],
                $row['program'],
                $row['created_at'],
                $row['deleted'],
            );
            echo ( $row['id'] . " " . $row['program']." ". "<br>");
    
        }
        return $tuition;


    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
}


/**
 * update tuition
 *
 * @param int $id
 * @return $tuition
 */
 public function updateTuition(Tuition $tuition)
 {
     try {
          $sql = 'UPDATE tuitions SET 
            created_by = :created_by, 
            last_modified_by = :last_modified_by,
            program_id = :program_id,
            section_id = :section_id,
            program = :program, 
            created_at = :created_at,
            deleted = :deleted WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $tuition->getId());
         $stmt->bindValue(':program_id', $tuition->getProgramId());
         $stmt->bindValue(':section_id', $tuition->getSectionId());
         $stmt->bindValue(':created_by', $tuition->getCreatedBy());
         $stmt->bindValue(':last_modified_by', $tuition->getLastModifiedBy());
         $stmt->bindValue(':program', $tuition->getProgram());
         $stmt->bindValue(':created_at', $tuition->getCreatedAt());
         $stmt->bindValue(':deleted', $tuition->getDeleted());


         if ($stmt->execute()) {
             return $tuition;
         }
         return null;
     } catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
 }

 /**
  * delete tuition
  *@param  int $id
  *@return bool

  */
  public function deleteTuition($id){
    try{
        $sql = 'UPDATE tuitions SET deleted = 1 WHERE id =:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id,);
        return $stmt->execute();
    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
  }

 
}