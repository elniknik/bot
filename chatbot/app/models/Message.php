<?php
namespace App\Models;

class Message {
    private $text;
    private $userId;

    public function __construct($text, $userId) {
        $this->text = $text;
        $this->userId = $userId;
    }

    public function getText() {
        return $this->text;
    }

    public function getUserId() {
        return $this->userId;
    }
}
