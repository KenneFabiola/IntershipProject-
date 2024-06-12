<?php
require_once("../api\models\Section.php");
class Sectionreposity{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of user
    public function createSection(Section $section)
    {
        $sql = "INSERT INTO users (created_at,school_year,created_by,last_modified_by,created_at) VALUES (:created_at, :school_year,:created_by,:last_modified_by,:created_at)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':created_at', $section->getCreatedAt());
        $stmt->bindValue(':school_year', $section->getSchoolYear());
        $stmt->bindValue(':created_by',$section->getCreatedBy());
        $stmt->bindValue(':last_modified_by',$section->getLastModifiedBy());
        if ($stmt->execute()) {
            $section->setId($this->pdo->lastInsertId());
            return $section;
        }
        return null;
        

}
}