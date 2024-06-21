<?php
// gestion des interactions avec la base de données;
require_once("../models/User.php");
class UserRepository
{
    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of user
    public function createUser(User $user)
    {
        try{
            $hashed_pwd = password_hash($user->getPwd(), PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username,first_name,last_name,email,pwd,role_id,deleted) VALUES (:username, :first_name, :last_name, :email,:pwd,:role_id,:deleted)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':first_name', $user->getFirstName());
            $stmt->bindValue(':last_name', $user->getLastName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':pwd', $hashed_pwd);
            $stmt->bindValue(':role_id', $user->getRoleId());
            $stmt->bindValue(':deleted', $user->getDeleted());
    
    
    
            if ($stmt->execute()) {
                $user->setId($this->pdo->lastInsertId());
                return $user;
            }
            return null;
        }catch(PDOException $e){
            echo 'PDOExeception: ' .$e->getMessage();
            return null;
        }
       
    }

//find user by their id
    public function findById($id)
    {
        try {
        $sql = 'SELECT * FROM users WHERE id = :id AND deleted = 0';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id'=> $id]);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new User(
                $result['id'],
                $result['username'],
                $result['first_name'],
                $result['last_name'],
                $result['email'],
                $result['pwd'],
                $result['role_id'],
                $result['deleted']
            );
        }
        return null;
    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
}
 // update user 
    public function updateUser(User $user)
    {
        try {
            $hashed_pwd = password_hash($user->getPwd(), PASSWORD_BCRYPT);
            $sql = 'UPDATE users SET first_name =:first_name,last_name=:last_name, email=:email,pwd=:pwd,username=:username,role_id=:role_id WHERE id =:id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $user->getId());
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':first_name', $user->getFirstName());
            $stmt->bindValue(':last_name', $user->getLastName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':pwd', $hashed_pwd);
            $stmt->bindValue(':role_id', $user->getRoleId());


            if ($stmt->execute()) {
                return $user;
            }
            return null;
        } catch (PDOException $e) {
            echo 'PDOExecption:' . $e->getMessage();
        }
    }

    // find by username 
    public function findByUsername($username){
        try{
            $sql = 'SELECT * FROM users WHERE  username = :usename';
            $stmt=$this->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);


        } catch (PDOException $e) {
            echo 'PDOExecption:' . $e->getMessage();
        }
    }




    // delete user

    public function deleteUser($id)
    {
        try {
            $sql = 'UPDATE users SET deleted = 1 WHERE id =:id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id,);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDOExecption:' . $e->getMessage();
        }
    }




    // read user
    public function findAll(){
        try{
            $sql = 'SELECT * FROM users';
            $stmt = $this->pdo->query($sql);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $user = new User(
                    $row['id'],
                    $row['username'],
                    $row['first_name'],
                    $row['last_name'],
                    $row['email'],
                    $row['pwd'],
                    $row['role_id'],
                    $row['deleted']
                );
              
                echo ( $row['id'] . " " . $row['username'] . " ". $row['first_name']. " ". $row['last_name']." ".$row['email']." ". $row['pwd']." ". $row['role_id']." ". "<br>");
            }
            return $user;
        }catch(PDOException $e){
            echo 'PDOExecption:' .$e->getMessage();
            return[];
        }
    }

}
