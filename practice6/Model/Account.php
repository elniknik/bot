<?php

namespace Model;

class Account extends Model {
    protected $table = "account";

    public function __construct()
    {
        parent::__construct();
    }

    public function getByapplicantId($applicantId) {
        $prepare = [
            ":applicant_id" => $applicantId,
        ];

        return $this->exec("SELECT * FROM `" . $this->table . "` WHERE `applicant_id`=':applicant_id'", $prepare);
    }

    public function getByAccountNumber($accountNumber) {
        $prepare = [
            ":account_number" => $accountNumber,
        ];

        return $this->execOne("SELECT `id`, `applicant_id`, `balance` FROM `" . $this->table . "` WHERE `account_number`=':account_number' LIMIT 1", $prepare);
    }

    public function getTotalByapplicantId($applicantId) {
        $prepare = [
            ":applicant_id" => (int)$applicantId,
        ];

        $row = $this->execOne("SELECT COUNT(`id`) AS `total` FROM `" . $this->table . "` WHERE `applicant_id`=':applicant_id'", $prepare);

        return (int)$row["total"];
    }

    public function changeBalance($accountNumber, $amount) {
        $prepare = [
            ":account_number" => $accountNumber,
            ":amount" => (double)$amount,
        ];

        $this->exec("UPDATE `" . $this->table . "` SET `balance`=`balance`+(:amount) WHERE `account_number`=':account_number' LIMIT 1", $prepare);
    }
}