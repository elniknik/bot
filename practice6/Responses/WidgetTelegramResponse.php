<?php

namespace Responses

class WidgetTelegramResponse {
    // Properties to store data
    private $authDate;
    private $firstName;
    private $chatId;
    private $hash;

    // Constructor to initialize data
    public function __construct($authDate, $firstName, $chatId, $hash) {
        $this->authDate = $authDate;
        $this->firstName = $firstName;
        $this->chatId = $chatId;
        $this->hash = $hash;
    }

    // Method to get the authentication date
    public function getAuthDate() {
        return $this->authDate;
    }

    // Method to get the user's first name
    public function getFirstName() {
        return $this->firstName;
    }

    // Method to get the chat ID
    public function getChatId() {
        return $this->chatId;
    }

    // Method to get the hash for verification
    public function getHash() {
        return $this->hash;
    }

    // Method to get all data as an associative array
    public function toArray() {
        return [
            'auth_date' => $this->authDate,
            'first_name' => $this->firstName,
            'chat_id' => $this->chatId,
            'hash' => $this->hash,
        ];
    }
}

?>
