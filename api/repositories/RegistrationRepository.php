<?php
// gestion des interactions avec la base de données;
require_once dirname(dirname(__DIR__)) .DIRECTORY_SEPARATOR .'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Registration.php' ;

class RegistrationRepository{

    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // create new registration
    public function createRegistration(Registration $registration)
    {
        $verify = "SELECT COUNT(*) FROM registrations WHERE student_id = :student_id AND program_id = :program_id AND deleted = false";
        $verifystmt = $this->pdo->prepare($verify);
        $verifystmt->bindValue(':student_id',$registration->getStudentId());
        // $verifystmt->bindValue(':section_id',$registration->getSectionId());
        $verifystmt->bindValue(':program_id',$registration->getProgramId());
        $verifystmt->execute();

        if($verifystmt->fetchColumn() > 0) {
            return 3;
        }elseif($verifystmt->fetchColumn() > 2) {
            return 6;

        }


        $sql = "INSERT INTO registrations (student_id,section_id,program_id,created_by,last_modified_by,created_at,deleted)
         VALUES (:student_id,:section_id,:program_id,:created_by,:last_modified_by,:created_at,:deleted)";
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
            $select = "UPDATE students SET registration = true WHERE id = :student_id AND deleted = false";
            $statement = $this->pdo->prepare($select);
            $statement->bindValue(':student_id',$registration->getStudentId());
            $statement->execute();
            if($statement->execute()) {
                return 4;
            }else{
                return 5;
            }
            return 1;
        }
        return 0;
        
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
            $sql = "SELECT r.*, 
        s1.first_name AS firstname,
         s2.last_name AS lastname,
          u1.username AS created_by_username, 
          u2.username AS last_modified_by_username,
           se1.school_year AS school_year, 
           se2.months AS months, 
           p1.program_name AS program_name, 
           p2.level_name AS level_name 
           FROM registrations r LEFT JOIN users u1 ON r.created_by = u1.id 
           LEFT JOIN users u2 ON r.last_modified_by = u2.id 
           LEFT JOIN programs p1 ON r.program_id = p1.id 
           LEFT JOIN programs p2 ON r.program_id = p2.id 
           LEFT JOIN sections se1 ON r.section_id = se1.id
           LEFT JOIN sections se2 ON r.section_id = se2.id
            LEFT JOIN students s1 ON r.student_id = s1.id
            LEFT JOIN students s2 ON r.student_id = s2.id
             WHERE r.deleted = false AND r.id = :id ORDER BY r.id ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id'=> $id]);
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
            $result['statut'],
            $result['deleted'],
           

        );

       
    }
    return null;
}catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}

public function findSessionById($section_id) {
    try {
        $sql = "SELECT r.*,
         s1.first_name AS firstname,
         s2.last_name AS lastname,
         p1.program_name AS program_name, 
        p2.level_name AS level_name ,
        se1.school_year AS school_year,
        se2.months AS months
        FROM registrations r
        LEFT JOIN students s1 ON r.student_id = s1.id
        LEFT jOIN students s2 ON r.student_id = s2.id
        LEFT JOIN programs p1 ON r.program_id = p1.id
        LEFT JOIN programs p2 ON r.program_id = p2.id
        LEFT JOIN sections se1 ON r.section_id = se1.id
        LEFT JOIN sections se2 ON r.section_id = se2.id
        WHERE r.section_id = :section_id AND r.deleted = false ORDER BY r.id ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':section_id' => $section_id]);
        $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $registrations;
    }catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}
public function findRegistrationForFinishSession($section_id) {
    try {
        $sql = "SELECT r.*,
         s1.first_name AS first_name,
         s2.last_name AS last_name,
         p1.program_name AS program_name, 
        p2.level_name AS level_name,
        s.months AS months,
        s.school_year AS school_year,
        s.statut AS statut
        FROM registrations r
        LEFT JOIN students s1 ON r.student_id = s1.id
        LEFT jOIN students s2 ON r.student_id = s2.id
        LEFT JOIN programs p1 ON r.program_id = p1.id
        LEFT JOIN programs p2 ON r.program_id = p2.id
        LEFT JOIN sections s ON  r.section_id = s.id
        WHERE r.section_id = :section_id
        AND r.deleted = false
        AND s.statut = 'inactive' 
        ORDER BY r.id ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':section_id' => $section_id]);
        $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $registrations;
    }catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}

}

public function studentRegisterBySession($section_id) {
    try{
            $sqll = "SELECT s.id,
            s.first_name,
            s.last_name,
            se.school_year AS school_year,
            se.months AS months,
            p.program_name AS program_name,
            p.level_name AS level_name,
            FROM students s
            LEFT JOIN registrations r
            LEFT JOIN programs p ON r.program_id = p.id
            LEFT JOIN sections se ON se.id = r.section_id
            
            WHERE s.id NOT IN 
            (SELECT r.student_id
            FROM registrations r
            WHERE r.section_id = :section_id
            AND r.deleted = false )";
    
            $statement = $this->pdo->prepare($sqll);
            $statement->bindValue(':section_id',$section_id);
            $statement->execute();
            $registration_student = [];
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $registration_student[] = $row;
            }
            return $registration_student;

    }catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}

public function studentRegisterByProgram() {
    try{
       
            $sql = "SELECT s.id,
            s.first_name,
            s.last_name,
            p.program_name,
            p.program_level,
            p.id 
            FROM students s
            LEFT JOIN programs p ON prodram_id = p.id
            WHERE s.id NOT IN 
            (SELECT r.student_id
            FROM registrations r
            WHERE r.program_id = :program_id
            AND r.deleted = false )";
    
            $statement = $this->pdo->prepare($sql);
            // $statement->bindValue(':section_id',$section_id);
            $statement->execute();
            $registration_student = [];
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $registration_student[] = $row;
            }
            return $registration_student;


    }catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}

public function findNewProgramForStudent($section_id) {
    $sql = "SELECT p.id,
    p.program_name,
    p.level_name
    FROM programs p WHERE 
    p.id IN (SELECT t.program_id 
    FROM tuitions t WHERE section_id = :section_id) AND 
    p.id NOT IN
    (SELECT r.program_id
    FROM registrations r WHERE r.student_id = :student_id
    AND r.deleted = false)";

    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':section_id',$section_id);
    $statement->execute();
    $new_programs = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $new_programs[] = $row;
    }
    return $new_programs;
  


}

/**
 * find registration who haven't deleted so who deleted= false
 *
 * @return array
 */
public function findAll(){
    try {
        $sql = "SELECT r.*, 
        s1.first_name AS firstname,
         s2.last_name AS lastname,
          u1.username AS created_by_username, 
          u2.username AS last_modified_by_username,
           se1.school_year AS school_year, 
           se2.months AS months, 
           p1.program_name AS program_name, 
           p2.level_name AS level_name 
           FROM registrations r LEFT JOIN users u1 ON r.created_by = u1.id 
           LEFT JOIN users u2 ON r.last_modified_by = u2.id 
           LEFT JOIN programs p1 ON r.program_id = p1.id 
           LEFT JOIN programs p2 ON r.program_id = p2.id 
           LEFT JOIN sections se1 ON r.section_id = se1.id
           LEFT JOIN sections se2 ON r.section_id = se2.id
            LEFT JOIN students s1 ON r.student_id = s1.id
            LEFT JOIN students s2 ON r.student_id = s2.id
             WHERE r.deleted = false ORDER BY r.id ";
        $stmt = $this->pdo->query($sql);
        $registrations = [];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
            $registrations[] = $row;
    
        }
        return $registrations;

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
            program_id = :program_id,
            last_modified_by = :last_modified_by
             WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $registration->getId());
         $stmt->bindValue(':program_id', $registration->getProgramId());
         $stmt->bindValue(':last_modified_by',$registration->getLastModifiedBy()); 

         if ($stmt->execute()) {
             return 1;
         }
         return 0;
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