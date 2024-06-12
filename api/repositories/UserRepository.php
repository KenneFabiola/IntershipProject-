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
        $hashed_pwd = password_hash($user->getPwd(), PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username,first_name,last_name,email,pwd,role_id) VALUES (:username, :first_name, :last_name, :email,:pwd,:role_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':first_name', $user->getFirstName());
        $stmt->bindValue(':last_name', $user->getLastName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':pwd', $hashed_pwd);
        $stmt->bindValue(':role_id', $user->getRoleId());



        if ($stmt->execute()) {
            $user->setId($this->pdo->lastInsertId());
            return $user;
        }
        return null;
    }

//find user by their id
    public function findById($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
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
                $result['role_id']
            );
        }
        return null;
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




    // delete user

    public function deleteUser($id)
    {
        try {
            $sql = 'DELETE FROM users WHERE id =:id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id,);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDOExecption:' . $e->getMessage();
        }
    }




    // read user
    public function readUser(){
        try{
            $sql = 'SELECT * FROM users';
            $stmt = $this->pdo->query($sql);

            $user = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $user[] = new User(
                    $row['id'],
                    $row['username'],
                    $row['first_name'],
                    $row['last_name'],
                    $row['email'],
                    $row['password'],
                    $row['role_id']
                );
            }
            return null;
        }catch(PDOException $e){
            echo 'PDOExecption:' .$e->getMessage();
        }
    }

}
