<?php
require_once("../../Database.php");
require_once("../repositories/UserRepository.php");
require_once("../repositories/PaymentRepository.php");
require_once("../repositories/paymentRepository.php");


class PaymentController {
    private $payment_service;
    private $user_repository;
    private $registration_repository;

    public function __construct($pdo) {
        $this->payment_service = new PaymentService($pdo);
        $this->user_repository = new UserRepository($pdo); 
        $this->registration_repository = new RegistrationRepository($pdo); 
        
    }

    // create payment
    public function createPayment() {
      $id = 5;
      $registration_id = 1;
     

      $user = $this->user_repository-> findById($id);
      $registration = $this->registration_repository->findById($registration_id);

      if($user && $registration) {
        $created_by = $user->getId();
        $last_modified_by = $user->getId();
        $registration_id = $registration->getId();
       
        $amount = $_POST['amount'];
        
        // Création de l'objet payment
        $payment = new payment(
            null,
            $amount,
            null,
            $created_by,
            $last_modified_by,
            false,
            $registration_id,
        
                
        );
            // get service for authentification
        $createdPayment = $this->payment_service->createPayment($payment);

        if ($createdPayment) {
            echo json_encode(['success' => 'payment created successfully']);
        } else {
            echo json_encode(['error' => 'Failed to create payment']);
        }
    } else {
        echo json_encode(['error' => 'user or section or program not found']);

      }
    }

    // update payment
    public function updatePayment() {
    
        $id = 5;
        $registration_id = 1;
        $user = $this->user_repository->findById($id);
        $registration = $this->registration_repository->findById($registration_id);

        if ($user  && $registration) {
            $created_by = $user->getId();
            $last_modified_by = $user->getId();
            $registration_id = $registration->getId();
            $input_data = json_decode(file_get_contents("php://input"), true);

            $id = $input_data['id'] ?? null;
            $user = $this->payment_service->findById($id);

        $id = $input_data['id'] ?? null;
        $payment = $this->payment_service->findById($id);
        if ($payment) {
            $payment->setamount($input_data['amount'] ?? $payment->getAmount());
            $payment->setCreatedAt($input_data['created_at'] ?? $payment->getCreatedAt());
            $payment->setLastModifiedBy($last_modified_by);
            $payment->setCreatedBy($payment->getCreatedBy());
            $payment->setDeleted($input_data['deleted'] ?? $payment->getDeleted());
            $payment->setRegistrationId($input_data['registration_id'] ?? $payment->getRegistrationId());
                
            $updatepayment = $this->payment_service->updatepayment($payment, $last_modified_by);
            if ($updatepayment) {
                echo json_encode(['success' => 'payment updated successfully']);
            } else {
                echo json_encode(['error' => 'Failed to update payment']);
            }
        } else {
            echo json_encode(['error' => 'payment not found']);
        }
    }
    }

    // delete payment
    public function deletePayment() {
        
        $input_data = json_decode(file_get_contents("php://input"), true);
        $id = $input_data['id'] ?? null;
        if ($id) {
            $deleted = $this->payment_service->deletePayment($id);
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
    public function getAllPayments() {
        $payments = $this->payment_service->findAll();
        if ($payments) {
            echo json_encode($payments);
        } else {
            echo json_encode(['error' => 'No payments found']);
        }
    }
}

// Connexion à la base de données et création de l'instance du contrôleur
$database = new Database();
$pdo = $database->connect();
$controller = new paymentController($pdo);

// Gestion des requêtes HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->createPayment();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller->updatePayment();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller->deletePayment();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $controller->getPaymentById($_GET['id']);
    } else {
        $controller->getAllPayments();
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>