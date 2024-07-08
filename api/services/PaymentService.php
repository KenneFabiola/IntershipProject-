<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'PaymentRepository.php';


class PaymentService {
    private $payment_repository;

    public function __construct($pdo) {
        $this->payment_repository = new PaymentRepository($pdo);
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

    public function findAll() {
        return $this->payment_repository->findAll();
    }

  
}