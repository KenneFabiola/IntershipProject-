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
    public function createTuition(Tuition $tuition,$id)
    {
        $count = "SELECT COUNT(*) FROM tuitions WHERE program_id = :program_id AND section_id = :section_id AND deleted= false";
        $statement_count = $this->pdo->prepare($count);
        $statement_count->bindValue(':program_id',$tuition->getProgramId());
        $statement_count->bindValue(':section_id',$tuition->getSectionId());
        $statement_count->execute();
        if($statement_count->fetchColumn() > 0) {
            return 5;
        }
        $verify = "SELECT availabilities FROM programs WHERE id = :id";
        $statement = $this->pdo->prepare($verify);
        $statement->bindValue(':id',$id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result['availabilities'] === 'ouvert') {
           
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
                return 1;
                
            }else {
                return 0;

            }
        }
        return 4;        

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
    $stmt->bindValue(':id',$id);
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

public function findTuitionBySectionId($section_id) {
    try {
        $sql = "SELECT t.*,
        s1.school_year AS school_year,
        s2.months AS months,
        s3.statut AS statut,
        p1.program_name AS program_name,
        p2.level_name AS level_name
        FROM tuitions t
        LEFT JOIN sections s1 ON t.section_id = s1.id
        LEFT JOIN sections s2 ON t.section_id = s2.id
        LEFT JOIN sections s3 ON t.section_id = s3.id
        LEFT JOIN programs p1 ON t.program_id = p1.id
        LEFT JOIN programs p2 ON t.program_id = p2.id
        WHERE t.section_id = :section_id 
        AND s3.statut = 'active'
        AND t.deleted = false
        ORDER BY t.id ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':section_id' => $section_id]);
        $tuitions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tuitions;
    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
}

public function findProgramBySession($section_id) {
    $sql = "SELECT p.id, p.program_name,p.level_name 
            FROM programs p 
            LEFT JOIN tuitions t ON t.program_id = p.id
            WHERE t.section_id = :section_id";
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':section_id',$section_id);
    $statement->execute();

    $programs = [];
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $programs[] = $row;
    }
    return $programs;
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
             return 1;
         }
         return 0;
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