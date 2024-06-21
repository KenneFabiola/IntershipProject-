<?php
require_once('../../Database.php');
require_once("..\models\Program.php");
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
        $sql = "INSERT INTO programs (created_by,last_modified_by,program_name,amount,duration,deleted,created_at) VALUES (:created_by,:last_modified_by,:program_name,:amount,:duration,:deleted,:created_at)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('program_name', $program->getProgramName());
        $stmt->bindValue(':amount', $program->getAmount());
        $stmt->bindValue(':duration', $program->getDuration());
        $stmt->bindValue(':created_by', $program->getCreatedBy());
        $stmt->bindValue(':last_modified_by', $program->getLastModifiedBy());
        $stmt->bindValue(':created_at', $program->getCreatedAt());
        $stmt->bindValue(':deleted', $program->getDeleted());
        if ($stmt->execute()) {
            $program->setId($this->pdo->lastInsertId());
            return $program;
        }
        return null;
    }
    //find program by their id
    public function findById($id)
    {
        try {
            $sql = 'SELECT * FROM programs WHERE id = :id AND deleted = 0';      
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
        
                
                return new Program(
                    $result['id'],
                    $result['program_name'],
                    $result['amount'],
                    $result['duration'],
                    $result['created_by'],
                    $result['last_modified_by'],
                    $result['created_at'],
                    $result['deleted'],
                    $result['created_by'],
                    $result['last_modified_by']
                );

                echo ( $result['id'] . " " . $result['program_name'] . " ". $result['amount']. " ". $result['duration']." "."<br>");
       
            }
            return null;
        } catch (PDOException $e) {
            echo 'PDOExeception: ' . $e->getMessage();
            return null;
        }
    }

    // read program
    public function findAll(){
        try{
            $sql = 'SELECT * FROM programs';
            $stmt = $this->pdo->query($sql);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $user = new User(
                    $row['id'],
                    $row['program_name'],
                    $row['amount'],
                    $row['duration'],
                    $row['created_at'],
                    $row['deleted'],
                    $row['created_by'],
                    $row['last_modified_by']
                );
              
                echo ( $row['id'] . " " . $row['program_name'] . " ". $row['amount']. " ". $row['duration']." ". $row['created_at']." ". $row['deleted']." ".$row['created_by']." ". $row['last_modified_by']." ". "<br>");
            }
            return $user;
        }catch(PDOException $e){
            echo 'PDOExecption:' .$e->getMessage();
            return[];
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
            amount = :amount,
            duration = :duration,
            created_by  =:created_by,
            last_modified_by = :last_modified_by,
            created_at = :created_at ,
            deleted = :deleted WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $program->getId());
         $stmt->bindValue(':program_name', $program->getProgramName());
         $stmt->bindValue(':amount', $program->getAmount());
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


}





