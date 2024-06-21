<?php
require_once('../../Database.php');
require_once("..\models\Section.php");
class SectionRepository{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // create section
    public function createSection(Section $section)
    {
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
            return $section;
        }
        return null;
        

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
            $result['School_year'],
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
public function findAll(){
    try {
        $stmt = $this->pdo->prepare('SELECT * FROM sections WHERE deleted=false');
        $stmt->execute();
        $section =[];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
            $section = new Section(
                $row['id'],
                $row['school_year'],
                $row['statut'],
                $row['created_by'],
                $row['last_modified_by'],
                $row['created_at'],
                $row['deleted']
            );
            echo ( $row['id'] . " " . $row['school_year'] . " ". $row['statut']." ". "<br>");
     
        }
        return $section;


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

  
}