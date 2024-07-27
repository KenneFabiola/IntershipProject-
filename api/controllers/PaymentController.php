<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'UserRepository.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'PaymentService.php';



class PaymentController {
    private $payment_service;
    private $user_repository;


    public function __construct() {
        $this->payment_service = new PaymentService();
        $this->user_repository = new UserRepository(); 
        
    }

    // create payment
    public function createPayment() {
        if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
            echo json_encode(['error' => 'unauthorized']);
            exit();
        }

        if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) { {
                echo json_encode(['error' => 'unauthorized']);
                exit();
            }
        }
        if(isset($_POST['addPayment'])) {
            $created_by = $_SESSION['id'];
            $last_modified_by = $_SESSION['id'];
            $registration_id = htmlspecialchars($_POST['registrationId']);
            $amount = $_POST['amount'];
            
            // Création de l'objet payment
            $payment = new Payment(
                null,
                $amount,
                null,
                null,
                $created_by,
                $last_modified_by,
                false,
                $registration_id,
            
                    
            );
                // get service for authentification
            $createdPayment = $this->payment_service->createPayment($payment);
    
            if ($createdPayment === 1) {
                $_SESSION['error'] = "le montant que vous venez d'entré donnera un resultat supérieur au frais définir pour ce programme"; 
     
            }elseif($createdPayment === 2) {
                $_SESSION['success'] ="les frais de scolarité pour cette étudiant sont complétement payés"; 
   
            }elseif($createdPayment === 5) {
                echo 'le nouveau payment est trop grand';
            }elseif($createdPayment === 4) {
                $_SESSION['error'] = "Echec de la mise à jour du statut dans la table payement"; 
   
            }elseif($createdPayment === 5) {
                $_SESSION['error'] = "le satut des payement n'était pas actifs"; 
   
            }elseif($createdPayment === 6) {
                $_SESSION['success'] = "Succés dans le traitement d'ajout d'un nouveau payement"; 
   
            }
             else {
                echo 'false';
            }
        }
       
    }

    public function updatePayment() {
        if (!isset($_SESSION['password']) || !isset($_SESSION['username'])) {
            echo json_encode(['error' => 'unauthorized']);
            exit();
        }

        if ($_SESSION['role'] !== 1 && $_SESSION['role'] !== 2) { {
                echo json_encode(['error' => 'unauthorized']);
                exit();
            }
        }

        if(isset($_POST['updatePayment'])) {
        $last_modified_by = intval($_POST['last_modified_by']);
        $id = intval($_POST['paymentId']);
        $registration_id = intval($_POST['registration_id']);
        $amount = floatval($_POST['amount']); echo $amount;

        $payment = $this->payment_service->findById($id);

        if($payment) {
            $payment->setLastModifiedBy($last_modified_by);
            $payment->setRegistrationId($registration_id ?? $payment->getRegistrationId());
            $payment->setAmount($amount ?? $payment->getAmount());

            $updated_payment = $this->payment_service->updatePayment($payment);
            if($updated_payment === 1) {
                // echo "id du payemnt n'est pas trouvé ";
                $_SESSION['error'] = "l'id de ce  payemnt n'a pas trouvé"; 
            }elseif(($updated_payment === 2)) {
                // echo "votre montant es sup";
                $_SESSION['error'] = "le montant que vous venez d'entré donnera un resultat supérieur au frais définir pour ce programme"; 
            }elseif(($updated_payment === 3)) {
                $_SESSION['success'] = "le statut de la table registration à été mis a jour";
            }elseif(($updated_payment === 4)) {
                // echo "erreur in regis";
                $_SESSION['error'] = "Echec durant la mise  à jour du statut de la table registration"; 

            }elseif(($updated_payment === 5)) {
                // echo 'echec in pay';
                $_SESSION['error'] = "Echec durant la mise à jour du statut de la table payement"; 

            }elseif(($updated_payment === 6)) {
                // echo "ok";
                $_SESSION['success'] = "Nouveau payement inseré avec succés"; 

            }else {
                // echo "error";
                $_SESSION['error'] = "Echec durant le traitement de modification de ce payement, veuillez ressayez"; 

            }
            

        }
        }
    }

  

    // delete payment
    public function deletePayment() {
        
        $input_data = json_decode(file_get_contents("php://input"), true);
        $id = $input_data['id'] ?? null;
        if ($id) {
            $deleted = $this->payment_service->deletepayment($id);
            if ($deleted) {
                echo json_encode(['success' => 'payment deleted']);
            } else {
                echo json_encode(['error' => 'Failed to delete payment']);
            }
        } else {
            echo json_encode(['error' => 'payment ID not provided']);
        }
    }

    // Méthode pour récupérer un étudiant par ID
    public function getPaymentById($id) {
        $payment = $this->payment_service->findById($id);
        if ($payment) {
            echo json_encode($payment);
        } else {
            echo json_encode(['error' => 'payment not found']);
        }
    }

    // Méthode pour récupérer tous les étudiants
    public function getAllPaymentBySession($section_id) {
        $payment_by_session = $this->payment_service->findAllBySession($section_id);
        if ($payment_by_session) {
           
            return json_encode($payment_by_session);
        } else {
            return json_encode(['error' => 'No payments found']);
        }
    }
    public function getAllFinishPaymentBySession($section_id) {
        $finish_payment_by_session = $this->payment_service->findAllFinishPaymentBySession($section_id);
        if ($finish_payment_by_session) {
          
            return json_encode($finish_payment_by_session);
        } else {
            return json_encode(['error' => 'No payments found']);
        }
    }

    public function  findPaymentByregistration($registration_id) {
        $payment_by_registration = $this->payment_service-> findPaymentByregistration($registration_id);
        if($payment_by_registration) {
            return json_encode($payment_by_registration);
        }else {
            return json_encode(['error' => 'No payments found']);

        }

    }

    public function  findPaymentsByregistration($registration_id) {
        $payments_by_registration = $this->payment_service-> findPaymentsByregistration($registration_id);
        if($payments_by_registration) {
            return json_encode($payments_by_registration);
        }else {
            return json_encode(['error' => 'No payments found']);

        }

    }

//  trouver tout les payement d'une session terminé
    public function findPaymentForfinishSession($section_id) {
        $payment_for_finish_session = $this->payment_service->findPaymentForfinishSession($section_id);
        if($payment_for_finish_session) {
            return json_encode($payment_for_finish_session);
        }else {
            return json_encode(['error' => 'No payments found']);

        }
    }


}

// Connexion à la base de données et création de l'instance du contrôleur
$database = new Database();
$pdo = $database->connect();
$payment_controller = new PaymentController();

if(isset($_POST['addPayment'])) {
    $payment_controller->createPayment();
}

if(isset($_POST['updatePayment'])) {
    $payment_controller->updatePayment();
}
