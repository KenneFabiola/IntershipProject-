<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Section.php' ;
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';

class SectionRepository{


    private $pdo;
    private $user_repository;
    
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // create section
    public function createSection(Section $section)
    {   
        $verify = "SELECT COUNT(*) FROM sections WHERE school_year = :school_year AND deleted = false ";
            $stmtverify = $this->pdo->prepare($verify);
            $stmtverify->bindValue(':school_year', $section->getSchoolYear());
            $stmtverify->execute();
            if($stmtverify->fetchColumn() > 0) {
                return ['error' => 'this section already exist'];
            }

       $sql = "INSERT INTO sections (school_year,created_by,last_modified_by,created_at,statut,deleted) VALUES (:school_year,:created_by,:last_modified_by,:created_at,:statut,:deleted)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':school_year', $section->getSchoolYear());
        $stmt->bindValue(':created_by',$section->getCreatedBy());
        $stmt->bindValue(':last_modified_by',$section->getLastModifiedBy());
        $stmt->bindValue(':created_at',$section->getCreatedAt());
        $stmt->bindValue(':statut', $section->getStatut());
        $stmt->bindValue(':deleted',$section->getDeleted());

        if ($stmt->execute()) {
            $section->setId($this->pdo->lastInsertId());
            return ['success' =>  $section];
        }
        return ['error' => 'failed'];
        

}
/**
 * find section by their id 
 *
 * @param int $id
 * @return Section|null
 */
public function findById($id)
{
    try {
    $sql = 'SELECT * FROM sections WHERE id = :id AND deleted = 0';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id'=> $id]);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return new Section(
            $result['id'],
            $result['school_year'],
            $result['statut'],
            $result['created_by'],
            $result['last_modified_by'],
            $result['created_at'],
            $result['deleted']
        );

        echo ( $result['id'] . " " . $result['school_year'] . " ". $result['statut']." ". "<br>");
       
    }
    return null;
}catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}
/**
 * find section who haven't deleted so who deleted= false
 *
 * @return array
 */
public function findAllSection(){
    try {
        $sql = 'SELECT s.*, u1.username AS created_by_username,
        u2.username AS last_modified_by
        FROM sections s
        LEFT JOIN users u1 ON s.created_by = u1.id
        LEFT JOIN users u2 ON s.last_modified_by = u2.id
         WHERE s.deleted=false AND statut= "active" 
         ORDER BY s.id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $sections =[];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
           
          
             $sections[] = $row;
            
        }
        return $sections;


    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
}


/**
 * update section
 *
 * @param int $id
 * @return $section
 */
 public function updateSection(Section $section)
 {
     try {
           $sql = 'UPDATE sections SET 
            school_year = :school_year,
            statut = :statut, 
            created_by = :created_by, 
            last_modified_by = :last_modified_by,
            created_at = :created_at,
            deleted = :deleted WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $section->getId());
         $stmt->bindValue(':created_at', $section->getCreatedAt());
         $stmt->bindValue(':school_year', $section->getSchoolYear());
         $stmt->bindValue(':created_by', $section->getCreatedBy());
         $stmt->bindValue(':last_modified_by', $section->getLastModifiedBy());
         $stmt->bindValue(':deleted', $section->getDeleted());
         $stmt->bindValue(':statut', $section->getStatut());


         if ($stmt->execute()) {
             return $section;
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
  public function deleteSection($id){
    try{
        $sql = 'UPDATE sections SET deleted = 1 WHERE id =:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id,);
        return $stmt->execute();
    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
  }
/**
 * Undocumented function
 *
 * @param [type] $id
 * @return bool
 */
  public function checkActiveSection ($id) {
    try {
        $sql = 'SELECT statut FROM sections WHERE statut= "active" AND deleted = false';
        // prepare the request with pdo
        $stmt = $this->pdo->prepare($sql);
        // exectution of the request by id of section
        $stmt->execute();
        // recupération du résultat de la requête sous forme de tableau associatifs
        $section = $stmt->fetch(PDO::FETCH_ASSOC);
        // retourne true si cette ligne est vrai et false dans le cas contraire
        return $section && $section['statut'] === 'active';

    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
  }

  public function finishSection($id) {
    try {
      
            $sql = 'UPDATE sections SET statut = "inactive" WHERE id =:id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id,);
            return $stmt->execute();
    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
  }

  public function getInactiveSection() {
    try {
        $sql = 'SELECT s.*, u1.username AS created_by_username,
        u2.username AS last_modified_by
        FROM sections s
        LEFT JOIN users u1 ON s.created_by = u1.id
        LEFT JOIN users u2 ON s.last_modified_by = u2.id
         WHERE s.deleted = false AND statut = "inactive" 
         ORDER BY s.id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $sections =[];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
           
          
             $sections[] = $row;
            
        }
        return $sections;


    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }

  }
  
}

