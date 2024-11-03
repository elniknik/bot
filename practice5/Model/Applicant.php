<?php

namespace Model;

class Applicant extends Model {
    protected $table = "applicants"; // Name of the table

    public function __construct() {
        parent::__construct();
    }

    public function getByEmail($email) {
        $prepare = [
            ":email" => $email,
        ];

        return $this->execOne("SELECT * FROM `" . $this->table . "` WHERE `email` = :email LIMIT 1", $prepare);
    }
    
    public function getByChatId($chatId) {
        $prepare = [
            ":chat_id" => $chatId,
        ];

        return $this->execOne("SELECT * FROM `" . $this->table . "` WHERE `chat_id`=':chat_id' LIMIT 1", $prepare);
    }
}
