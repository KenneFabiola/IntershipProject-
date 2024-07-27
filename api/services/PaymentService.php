<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'PaymentRepository.php';


class PaymentService {
    private $payment_repository;

    public function __construct() {
        $this->payment_repository = new PaymentRepository();
    }

    public function createPayment($payment) {
        return $this->payment_repository->createPayment($payment);
    }

    public function findById($id) {
        return $this->payment_repository->findById($id);
    }

    public function updatePayment($payment) {
        return $this->payment_repository->updatePayment($payment);
    }

    public function deletePayment($id) {
        return $this->payment_repository->deletePayment($id);
    }

    public function findAllBySession($section_id) {
        return $this->payment_repository->findAllBySession($section_id);
    }

    public function findPaymentForfinishSession($section_id) {
        return $this->payment_repository->findPaymentForfinishSession($section_id);
    }

    public function findAllFinishPaymentBySession($section_id) {
        return $this->payment_repository->findAllFinishPaymentBySession($section_id);
    }

    public function findPaymentByregistration($registration_id) {
        return $this->payment_repository->findPaymentByregistration($registration_id);

    }
    public function findPaymentsByregistration($registration_id) {
        return $this->payment_repository->findPaymentsByregistration($registration_id);

    }

  
}