<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Program.php' ;

class ProgramRepository
{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of user
    public function createProgram(Program $program)
    {
        try {
            $verify = "SELECT COUNT(*) FROM programs WHERE program_name = :program_name";
            $stmtverify = $this->pdo->prepare($verify);
            $stmtverify->bindValue(':program_name', $program->getProgramName());
            $stmtverify->execute();
            if($stmtverify->fetchColumn() > 0) {
                return ['error' => 'Program already exist'];
            }

    $sql = "INSERT INTO programs (created_by,last_modified_by,program_name,descriptive,duration,deleted,created_at) VALUES (:created_by,:last_modified_by,:program_name,:descriptive,:duration,:deleted,:created_at)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue('program_name', $program->getProgramName());
    $stmt->bindValue(':descriptive', $program->getDescriptive());
    $stmt->bindValue(':duration', $program->getDuration());
    $stmt->bindValue(':created_by', $program->getCreatedBy());
    $stmt->bindValue(':last_modified_by', $program->getLastModifiedBy());
    $stmt->bindValue(':created_at', $program->getCreatedAt());
    $stmt->bindValue(':deleted', $program->getDeleted());
    if ($stmt->execute()) {
        $program->setId($this->pdo->lastInsertId());
        return ['success' =>  $program];
    }
    return ['error' => 'failed'];

        } catch (PDOException $e) {
            echo 'PDOExeception: ' . $e->getMessage();
            return null;
        }
       
    }
    //find program by their id
    public function findById($program_id)
    {
        try {
            $sql = 'SELECT * FROM programs WHERE id = :id AND deleted = false';      
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $program_id]);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
        
                
                return new Program(
                    $result['id'],
                    $result['program_name'],
                    $result['descriptive'],
                    $result['duration'],
                    $result['created_by'],
                    $result['last_modified_by'],
                    $result['created_at'],
                    $result['deleted'],
                    $result['created_by'],
                    $result['last_modified_by']
                );

                
            }
            return null;
        } catch (PDOException $e) {
            echo 'PDOExeception: ' . $e->getMessage();
            return null;
        }
    }

    // read program
    public function findAllProgram(){
        try{
            $sql = 'SELECT p.*,
            u1.username AS created_by_username,
            u2.username AS last_modified_by_username
            FROM programs p
            LEFT JOIN users u1 ON p.created_by = u1.id
            LEFT JOIN users u2 ON p.last_modified_by = u2.id
            WHERE p.deleted = false
            ORDER BY p.id';
            $stmt = $this->pdo->query($sql);
            $programs = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
               $programs[] = $row;
              
            }
            return $programs;
        }catch(PDOException $e){
            echo 'PDOExecption:' .$e->getMessage();
            return null;
        }
    }

   


/**
 * update program
 */

    
 public function updateProgram(Program $program)
 {
     try {
         
         $sql = 'UPDATE programs SET 
            program_name = :program_name,
            descriptive = :descriptive,
            duration = :duration,
            created_by  = :created_by,
            last_modified_by = :last_modified_by,
            created_at = :created_at ,
            deleted = :deleted WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $program->getId());
         $stmt->bindValue(':program_name', $program->getProgramName());
         $stmt->bindValue(':descriptive', $program->getDescriptive());
         $stmt->bindValue(':duration', $program->getDuration());
         $stmt->bindValue(':created_by', $program->getCreatedBy());
         $stmt->bindValue(':last_modified_by', $program->getLastModifiedBy());
         $stmt->bindValue(':created_at', $program->getCreatedAt());
         $stmt->bindValue(':deleted', $program->getDeleted());


         if ($stmt->execute()) {
             return $program;
         }
         return null;
     } catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
 } 

 /**
  * delete program
  *@param  int $id
  *@return bool

  */
  public function deleteProgram($id){
    try{
        $sql = 'UPDATE programs SET deleted = 1 WHERE id =:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id,);
        return $stmt->execute();
    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
  }


/**
 * start with other method
 */

   // read programname
   public function findProgramName(){
    try{
        $sql = 'SELECT program_name FROM programs WHERE deleted = false';
        $stmt = $this->pdo->query($sql);
        $programs = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
       
           $programs[] = $row;
          
        }
        return $programs;
    }catch(PDOException $e){
        echo 'PDOExecption:' .$e->getMessage();
        return null;
    }
}


}





