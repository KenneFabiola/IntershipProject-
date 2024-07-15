<?php
session_start();
// gestion des interactions avec la base de données;
require_once dirname(dirname(__DIR__)) .DIRECTORY_SEPARATOR .'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'User.php' ;
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
            $verify = "SELECT COUNT(*) FROM users WHERE email = :email AND username = :username ";
            $stmtverify = $this->pdo->prepare($verify);
            $stmtverify->bindValue(':username', $user->getUsername());
            $stmtverify->bindValue(':email', $user->getEmail());
            $stmtverify->execute();
            if($stmtverify->fetchColumn() > 0) {
                return ['error' => 'User already exist'];
            }
             

            $find_password = $user->getPwd();
            $hashed_pwd = password_hash($find_password, PASSWORD_DEFAULT);
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
                // get id of new user 
                $user->setId($this->pdo->lastInsertId());
               
                return ['success' =>  $user];
            }
            return ['error' => 'failed'];
         
        }catch(PDOException $e){
          error_log('PDOExeception: ' .$e->getMessage());
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
          
            $sql = 'UPDATE users SET 
            username = :username,
            first_name = :first_name,
            last_name = :last_name, 
            email = :email,         
            role_id=:role_id
            WHERE id =:id';

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $user->getId());
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':first_name', $user->getFirstName());
            $stmt->bindValue(':last_name', $user->getLastName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':role_id', $user->getRoleId());


            if ($stmt->execute()) {
                return $user;
            }
            return null;
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
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDOExecption:' . $e->getMessage();
        }
    }




    // read user
    public function findAllUser(){
        try{
            
            $sql = 'SELECT u.*,  role_name
                FROM users u
                JOIN roles r ON u.role_id = r.id
                WHERE u.deleted = false ORDER BY u.id';
            $stmt = $this->pdo->query($sql);
            $users = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                $users[] = $row;
              
            }
            return $users;
        }catch(PDOException $e){
            echo 'PDOExecption:' .$e->getMessage();
            return[];
        }
    }


 // find by username 
    public function findByUsername($username) {
        try {
            $sql = 'SELECT * FROM users WHERE username = :username';
            $stmt = $this->pdo->prepare($sql);
            $stmt ->bindValue(':username',$username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
    
            if($result){
                return new User(
                    $result['id'],
                    $result['username'],
                    $result['first_name'],
                    $result['last_name'],
                    $result['email'],
                    $result['pwd'],
                    $result['deleted'],
                    $result['role_id']
                   
                );
    
            }
            return null;
    
        }catch (PDOException $e) {
             echo 'PDOExecption:' . $e->getMessage();
             return null;
         }
    }

    
 /**
   * find username by id
   */
  public function findUsernameUserById($id){
    try{
        $sql = 'SELECT username FROM users WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt ->bindParam(':id',$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
       

        if($result){
            return $result['username'];

        }
        return null;

    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
         return null;
     }

}
    

}
