<?php

class Applicant {
    private $pdo;
    public $applicant_id;
    public $name;
    public $email;
    public $phone_number;
    public $registration_date;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($name, $email, $phone_number) {
        $stmt = $this->pdo->prepare("INSERT INTO applicants (name, email, phone_number) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $phone_number]);
    }

    public function read($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM applicants WHERE applicant_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $phone_number) {
        $stmt = $this->pdo->prepare("UPDATE applicants SET name = ?, email = ?, phone_number = ? WHERE applicant_id = ?");
        return $stmt->execute([$name, $email, $phone_number, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM applicants WHERE applicant_id = ?");
        return $stmt->execute([$id]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM applicants");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
