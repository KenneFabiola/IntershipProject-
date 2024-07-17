<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Tuition.php' ;

class TuitionRepository{


    private $pdo;
  
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of tuition
    public function createTuition(Tuition $tuition)
    {
        $sql = "INSERT INTO tuitions (created_by,last_modified_by,program_id,section_id,amount,created_at,deleted) VALUES 
        (:created_by,:last_modified_by,:program_id,:section_id,:amount,:created_at,:deleted)";
        $stmt = $this->pdo->prepare($sql);   
        $stmt->bindValue(':created_by',$tuition->getCreatedBy());
        $stmt->bindValue(':last_modified_by',$tuition->getLastModifiedBy());
        $stmt->bindValue(':program_id', $tuition->getProgramId());
        $stmt->bindValue(':section_id', $tuition->getSectionId());
        $stmt->bindValue(':amount',$tuition->getAmount());
        $stmt->bindValue(':created_at',$tuition->getCreatedAt());
        $stmt->bindValue(':deleted',$tuition->getDeleted());

        if ($stmt->execute()) {
            $tuition->setId($this->pdo->lastInsertId());
            return ['success' =>  $tuition];
            
        }
        return ['error' => 'failed'];
        
        

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
            $result['amount'],
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
 * find tuition who haven't deleted so who deleted= false
 *
 * @return array
 */
public function findAllTuitions(){
    try {
        $sql = 'SELECT t.*, u1.username AS created_by,
        u2.username AS last_modified_by,
        s.school_year AS section,
        p1.program_name AS program, 
        p2.level_name AS level_name
        FROM tuitions t
        LEFT JOIN users u1 ON t.created_by = u1.id
        LEFT JOIN users u2 ON t.last_modified_by = u2.id
        LEFT JOIN sections s ON t.section_id = s.id
        LEFT JOIN programs p1 ON t.program_id = p1.id
        LEFT JOIN programs p2 ON t.program_id = p2.id
        WHERE p1.deleted = false AND p1.availabilities = "ouvert" AND t.deleted = false
        ORDER BY  t.id '; 
        $stmt = $this->pdo->query($sql);
        $tuitions = [];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
           
            $tuitions[] = $row;
    
        }
    
        return $tuitions;


    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return [];
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
            program_id = :program_id,
            section_id = :section_id,
            amount = :amount,
            created_by = :created_by, 
            last_modified_by = :last_modified_by
            WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $tuition->getId());
         $stmt->bindValue(':program_id', $tuition->getProgramId());
         $stmt->bindValue(':section_id', $tuition->getSectionId());
         $stmt->bindValue(':amount', $tuition->getAmount());
         $stmt->bindValue(':created_by', $tuition->getCreatedBy());
         $stmt->bindValue(':last_modified_by', $tuition->getLastModifiedBy());



         if ($stmt->execute()) {
             return ['success'=> $tuition];
         }
         return ['error' => 'failed'];
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

/**
 *  start with other method  */ 




}