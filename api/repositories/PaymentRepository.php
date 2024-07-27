<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Database.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Payment.php' ;

class PaymentRepository{


    private $pdo;
    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }
    // insertion of payment
    public function createPayment(Payment $payment)
    {

        //1 recuperer les couts total des frais de scolarité pour un enregistrement
        $registration_id = $payment->getRegistrationId();
        $sql_tuition = 'SELECT amount FROM tuitions
         WHERE program_id = ( SELECT program_id FROM registrations WHERE id = :registration_id )
         AND section_id = (SELECT section_id FROM registrations WHERE id = :registration_id)';

        $statment_tuition = $this->pdo->prepare($sql_tuition);
        $statment_tuition->bindValue(':registration_id',$registration_id);
        $statment_tuition->execute();
        // recuperer la premiere colonne du resultat envoyé
        $total_tuition = $statment_tuition->fetchColumn();

        // 2- recuperer la somme des payment déjà effectué pour un enregistrement donné

        $sql_total_payment = "SELECT SUM(amount) FROM payments WHERE registration_id = :registration_id";
        $statment_total_payement = $this->pdo->prepare($sql_total_payment);
        $statment_total_payement->bindValue(':registration_id',$registration_id);
        $statment_total_payement->execute();
        $total_payment = $statment_total_payement->fetchColumn();

        // 3- evaluer le reste à payer
        // si aucun montant n'a été versé , total payment doit prendre la valeur 0,
        $total_payment = $total_payment ? $total_payment : 0;
        

        //reste à payer 

        $remaining = $total_tuition - $total_payment;
        $payment_amount = $payment->getAmount();

        echo "le montant total des frais pour lequel l'nregistrement est effectué est : " .$total_tuition;
        echo "le total des payment déjà effectué est de  : " .$total_payment;
        echo "le reste à payer est de  : " .$remaining ;
        echo "votre nouveau payement est: " .$payment_amount ;

        if($payment_amount > $remaining) {
            return 1;
        }


        // traitement si le reste à payer est de 0
        if($remaining <= 0) {
            $sql_check_statut = 'SELECT statut FROM payments WHERE registration_id = :registration_id';
            $statement_check_statut = $this->pdo->prepare($sql_check_statut);
            $statement_check_statut->bindValue(':registration_id', $registration_id);
            $statement_check_statut->execute();
            $result_check_statut = $statement_check_statut->fetch(PDO::FETCH_ASSOC);

            if($result_check_statut && $result_check_statut['statut'] === 'actif') {
                $sql_statut = " UPDATE payments SET statut = 'terminer' WHERE registration_id = :registration_id ";
                $statement_statut = $this->pdo->prepare($sql_statut);
                $statement_statut->bindValue(':registration_id', $registration_id);
                $statement_statut->execute();
                 
                if($statement_statut->rowCount() > 0) {
        
                    //  mise a jour du statut d'un enregistrement pour un payment terminer
                    $sql_statut_registration = " UPDATE registrations SET statut = true WHERE id = :registration_id ";
                    $statement_statut_registration = $this->pdo->prepare($sql_statut_registration);
                    $statement_statut_registration->bindValue(':registration_id', $registration_id);
                    $result_upadte = $statement_statut_registration->execute();
                    if($result_upadte) {
                        return 2;
                    }

                    return 3;

                }else {
                    return 4;
                }
            }

            return 5;
                       
        }

        // verifier si le nouveau payment ne va pas depasser ce qu'il faut payé
        // 4- insertion d'un nouveau payment 

        $sql_insert_payment = "INSERT INTO payments (amount,created_at,created_by,last_modified_by,deleted,registration_id)
         VALUES
        (:amount, :created_at,:created_by,:last_modified_by,:deleted,:registration_id)";
        $stmt_insert_payment = $this->pdo->prepare($sql_insert_payment);
        $stmt_insert_payment->bindValue(':amount', $payment->getAmount());
        // $stmt_insert_payment->bindValue(':statut', $payment->getStatut());
        $stmt_insert_payment->bindValue(':created_at',$payment->getCreatedAt());
        $stmt_insert_payment->bindValue(':created_by',$payment->getCreatedBy());
        $stmt_insert_payment->bindValue(':last_modified_by',$payment->getLastModifiedBy());
        $stmt_insert_payment->bindValue(':deleted',$payment->getDeleted());
        $stmt_insert_payment->bindValue(':registration_id',$payment->getRegistrationId());

        if ($stmt_insert_payment->execute()) {
            $payment->setId($this->pdo->lastInsertId());
            return 6;
            
        }
        return 0;
    
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
            $result['statut'],
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
public function findAllBySession($section_id){
    try {

        // COUNT(*) compte le nombre total de ligne pour chaque registration_id par
       $sql = "SELECT pa.*,
                p1.program_name AS program_name,
                p1.level_name AS level_name ,
                s.first_name AS first_name,
                s.last_name AS last_name,
                se.school_year AS school_year,
                se.months AS months,
                t.amount AS total_to_paid,
                u.username AS created_by_username,

               COALESCE(SUM(pa.amount),0) AS total_paid,

               (t.amount - COALESCE(SUM(pa.amount),0)) AS remaining
               FROM payments pa
               LEFT JOIN registrations r ON r.id = pa.registration_id
               LEFT JOIN tuitions t ON r.program_id = t.program_id AND r.section_id = t.section_id
               LEFT JOIN programs p1 ON t.program_id = p1.id
               LEFT JOIN students s ON r.student_id = s.id
               LEFT JOIN sections se ON r.section_id = se.id
               LEFT JOIN users u ON pa.created_by = u.id
                WHERE se.id = :section_id AND pa.statut = 'actif'
                GROUP BY pa.registration_id,
                p1.level_name,
                s.first_name,
                s.last_name,
                se.school_year,
                se.months,
                t.amount";
       $statement = $this->pdo->prepare($sql);
       $statement->bindValue(':section_id', $section_id);
       $statement->execute();
       $payments = [];
       while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $payments[] = $row;
       }

       return $payments;

    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
}

public function findAllFinishPaymentBySession($section_id){
    try {

        // COUNT(*) compte le nombre total de ligne pour chaque registration_id par
       $sql = "SELECT pa.*,
                p1.program_name AS program_name,
                p1.level_name AS level_name ,
                s.first_name AS first_name,
                s.last_name AS last_name,
                se.school_year AS school_year,
                se.months AS months,
                t.amount AS total_to_paid,
                

               COALESCE(SUM(pa.amount),0) AS total_paid,

               (t.amount - COALESCE(SUM(pa.amount),0)) AS remaining
               FROM
                payments pa
               LEFT JOIN
                registrations r ON r.id = pa.registration_id
               LEFT JOIN
                tuitions t ON r.program_id = t.program_id AND r.section_id = t.section_id
               LEFT JOIN
                programs p1 ON t.program_id = p1.id
               LEFT JOIN
                students s ON r.student_id = s.id
               LEFT JOIN
                sections se ON r.section_id = se.id
               WHERE se.id = :section_id AND pa.statut = 'terminer'

                GROUP BY pa.registration_id,
                p1.level_name,
                s.first_name,
                s.last_name,
                se.school_year,
                se.months,
                t.amount";
       $statement = $this->pdo->prepare($sql);
       $statement->bindValue(':section_id', $section_id);
       $statement->execute();
       $payments = [];
       while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $payments [] = $row;
       }

       return $payments;

    }catch(PDOException $e){
        echo 'PDOExeception: ' .$e->getMessage();
        return null;
    }
}


public function findPaymentByregistration($registration_id) {
    try {
        $sql_find_last_payment = "SELECT pa.id,
        pa.created_at,
        pa.amount AS last_payment,
        s.first_name AS first_name,
        s.last_name AS last_name,
        p.program_name AS program_name,
        p.level_name AS level_name ,
        r.id AS registration_id
        FROM
        payments pa
        LEFT JOIN
        registrations r ON r.id = pa.registration_id
        LEFT JOIN 
        students s ON r.student_id = s.id
        LEFT JOIN 
        programs p ON r.program_id = p.id
        WHERE
        registration_id = :registration_id
        ORDER BY
            pa.created_at  DESC
        LIMIT 1
        ";

        $statement_last_payment = $this->pdo->prepare($sql_find_last_payment);
        $statement_last_payment->bindValue(':registration_id',$registration_id);
        $statement_last_payment->execute();
        $payment = [];
        while ($row = $statement_last_payment->fetch(PDO::FETCH_ASSOC)) {
            $payment[] = $row;
        }
        return $payment;

    
}catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}


public function findPaymentsByregistration($registration_id) {
    try {
        $sql_find_last_payment = "SELECT pa.id,
        pa.created_at,
        pa.amount AS amount,
        s.first_name AS first_name,
        s.last_name AS last_name,
        p.program_name AS program_name,
        p.level_name AS level_name ,
        r.id AS registration_id
        FROM
        payments pa
        LEFT JOIN
        registrations r ON r.id = pa.registration_id
        LEFT JOIN 
        students s ON r.student_id = s.id
        LEFT JOIN 
        programs p ON r.program_id = p.id
        WHERE
        registration_id = :registration_id
        ORDER BY
            pa.created_at  DESC
        ";

        $statement_last_payment = $this->pdo->prepare($sql_find_last_payment);
        $statement_last_payment->bindValue(':registration_id',$registration_id);
        $statement_last_payment->execute();
        $payment = [];
        while ($row = $statement_last_payment->fetch(PDO::FETCH_ASSOC)) {
            $payment[] = $row;
        }
        return $payment;

    
}catch(PDOException $e){
    echo 'PDOExeception: ' .$e->getMessage();
    return null;
}
}



 public function updatePayment(Payment $payment)
 {
     try {
        $registration_id = $payment->getRegistrationId();
        $sql_find_last_payment = "SELECT id 
        FROM
         payments
        WHERE
           registration_id = :registration_id
        ORDER BY
            created_at  DESC
        LIMIT 1
        ";

        $statement_last_payment = $this->pdo->prepare($sql_find_last_payment);
        $statement_last_payment->bindValue(':registration_id',$registration_id);
        $statement_last_payment->execute();
        $id_last_payment = $statement_last_payment->fetchColumn();
        if( $id_last_payment === false) {
            return 1;
        }


        $sql_tuition = "SELECT amount FROM tuitions
        WHERE program_id = (SELECT program_id FROM registrations
        WHERE id = :registration_id)
        AND section_id = (SELECT section_id FROM registrations WHERE id = :registration_id)";

        $statement_tuition = $this->pdo->prepare($sql_tuition);
        $statement_tuition->bindValue(':registration_id',$registration_id);
        $statement_tuition->execute();
        $total_tuition = $statement_tuition->fetchColumn();

        // recuperer la somme des payement déjà effectué
        $sql_total_payment = "SELECT SUM(amount)
         FROM 
         payments
         WHERE registration_id = :registration_id";
         $statement_total_tuition = $this->pdo->prepare($sql_total_payment);
         $statement_total_tuition->bindValue(':registration_id', $registration_id);
         $statement_total_tuition->execute();
         $total_payment = $statement_total_tuition->fetchColumn();

        $total_payment = $total_payment ? $total_payment : 0;

        // reste à payer 
        $remaining = $total_tuition - $total_payment;

        // recuperer le montant qu'il vient d'entrer 
        $payment_amount = $payment->getAmount();
//  si le payment que tu vient d'entrer est superieur au reste à payer
        if($payment_amount > $remaining ) {
            return 2;
        }
// si le reste à payer est de 0, on fait un updte des statut
        if($remaining <= 0) {
            $check_statut = "SELECT statut 
            FROM payments 
            WHERE registration_id = :registration_id";
            $statement_check_statut = $this->pdo->prepare($check_statut);
            $statement_check_statut->bindValue(':registration_id', $registration_id);
            $statement_check_statut->execute();
            $result_check_statut = $statement_check_statut->fetch(PDO::FETCH_ASSOC);

            if($result_check_statut['statut'] === 'actif') {
                $update_statut = "UPDATE payments
                SET statut = 'terminer'
                 WHERE registration_id = :registration_id ";
                 
                 $statement_statut = $this->pdo->prepare($update_statut);
                 $statement_statut->bindValue(':registration_id', $registration_id);
                 $statement_statut->execute();

                //  modifier le statut dans la table registration si le statut ici a été terminer

                if($statement_statut->rowCount() > 0) {
                    $sql_update_statut_registration = "UPDATE registrations
                    SET statut = true
                    WHERE registration_id = :registration_id";
                    $statement_statut_registration = $this->pdo->prepare($sql_update_statut_registration);
                    $statement_statut_registration->bindValue(':registration_id',$registration_id);

                    $result_update_registration =  $statement_statut_registration->execute();

                    if($result_update_registration) {
                        return 3;
                        // updtate reuissi
                    }
                    return 4;
                    // echec 

                }else {
                    return 5;
                    // echec dans payment
                }

            }
        }

        // modifification



          $sql = 'UPDATE payments SET 
            amount = :amount,
            last_modified_by=:last_modified_by,
            registration_id=:registration_id
            WHERE id =:id';

         $stmt = $this->pdo->prepare($sql);
         $stmt->bindValue(':id',$id_last_payment);
         $stmt->bindValue(':amount', $payment->getAmount());
         $stmt->bindValue(':last_modified_by',$payment->getLastModifiedBy());
         $stmt->bindValue(':registration_id',$payment->getRegistrationId());



         if ($stmt->execute()) {
             return 6;
         }
         return 7;
     } catch (PDOException $e) {
         echo 'PDOExecption:' . $e->getMessage();
     }
 }
//  payement pour les sessions terminés

public function findPaymentForfinishSession($section_id) {
    try {
    $sql = "SELECT pa.*,
    p1.program_name AS program_name,
    p1.level_name AS level_name,
    s.first_name AS first_name,
    s.last_name AS last_name,
    se.school_year AS school_year,
    se.months AS months,
    t.amount AS total_to_paid,
    u.username AS created_by_username,
    
    COALESCE (SUM(pa.amount),0) AS total_paid
    FROM payments pa
    LEFT JOIN
        registrations r ON r.id = pa.registration_id
    LEFT JOIN
         tuitions t ON r.program_id = t.program_id AND r.section_id = t.section_id
    LEFT JOIN 
        programs p1 ON t.program_id = p1.id
    LEFT JOIN 
        students s ON s.id = r.student_id
    LEFT JOIN
        sections se ON se.id = r.section_id
    LEFT JOIN 
        users u ON pa.created_by = u.id 
    WHERE 
        se.id = :section_id
         AND
        se.statut = 'inactive'
    GROUP BY pa.registration_id,
                p1.program_name,
                p1.level_name,
                s.first_name,
                s.last_name,
                se.school_year,
                se.months,
                t.amount";
     $statement = $this->pdo->prepare($sql);
     $statement->bindValue(':section_id', $section_id);
     $statement->execute();
     $payment_for_finish_session = [];
     while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      $payment_for_finish_session[] = $row;
     }

     return $payment_for_finish_session;

  }catch(PDOException $e){
      echo 'PDOExeception: ' .$e->getMessage();
      return null;
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