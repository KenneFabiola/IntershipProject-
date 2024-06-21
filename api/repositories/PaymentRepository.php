<?php
require_once('../../Database.php');
require_once("..\models\Payment.php");
class PaymentRepository{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of user
    public function createPayment(Payment $payment)
    {
        $sql = "INSERT INTO payments (amount,created_at,created_by,last_modified_by,deleted,registration_id) VALUES (:amount, :crteated_at,:created_by,:last_modified_by,:deleted,:registration_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':amount', $payment->getAmount());
        $stmt->bindValue(':created_at',$payment->getCreatedAt());
        $stmt->bindValue(':created_by',$payment->getCreatedBy());
        $stmt->bindValue(':last_modified_by',$payment->getLastModifiedBy());
        $stmt->bindValue(':deleted',$payment->getDeleted());
        $stmt->bindValue(':registration_id',$payment->getRegistrationId());

        if ($stmt->execute()) {
            $payment->setId($this->pdo->lastInsertId());
            return $payment;
        }
        return null;
        

}
/**
 * find payment by their id 
 *
 * @param int $id
 * @return payment|null
 */
public function findById($id)
{
    try {
    $sql = 'SELECT * FROM payments WHERE id = :id AND deleted = 0';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id'=> $id]);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return new payment(
            $result['id'],
            $result['amount'],
            $result['created_at'],
            $result['created_by'],
            $result['last_modified_by'],
             $result['deleted'],
             $result['registration_id'],
           

        );

        echo ( $result['id'] . " " . $result['amount']." ". "<br>");
       
    }
    return null;
}catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}
/**
 * find payment who haven't deleted so who deleted= false
 *
 * @return array
 */
public function findAll(){
    try {
        $stmt = $this->pdo->prepare('SELECT * FROM payments WHERE deleted=false');
        $stmt->execute();
        $payment =[];

        while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
            $payment = new Payment(
                $row['id'],
                $row['amount'],
                $row['created_at'],
                $row['created_by'],
                $row['last_modified_by'],
                $row['deleted'],
                $row['registration_id'],
               
            );
            echo ( $row['id'] . " " . $row['amount']." ". "<br>");
    
        }
        return $payment;


    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
}


/**
 * update payment
 *
 * @param int $id
 * @return $payment
 */
 public function updatePayment(Payment $payment)
 {
     try {
          $sql = 'UPDATE payments SET 
            amount = :amount,
            created_at=:created_at,
            created_by=:created_by, 
            last_modified_by=:last_modified_by,
            deleted=:deleted,
            registration_id=:registration_id
            WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id', $payment->getId());
         $stmt->bindValue(':amount', $payment->getAmount());
        $stmt->bindValue(':created_at',$payment->getCreatedAt());
        $stmt->bindValue(':created_by',$payment->getCreatedBy());
        $stmt->bindValue(':last_modified_by',$payment->getLastModifiedBy());
        $stmt->bindValue(':deleted',$payment->getDeleted());
        $stmt->bindValue(':registration_id',$payment->getRegistrationId());



         if ($stmt->execute()) {
             return $payment;
         }
         return null;
     } catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
 }

 /**
  * delete payment
  *@param  int $id
  *@return bool

  */
  public function deletePayment($id){
    try{
        $sql = 'UPDATE payments SET deleted = 1 WHERE id =:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id,);
        return $stmt->execute();
    }catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
  }

 
}