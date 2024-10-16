<?php
namespace App\Controllers;

use App\Models\Message;
use App\Models\User;

class BotController {
    public function handleRequest($data) {
        $user = new User($data['user_id'], $data['user_name']);
        $message = new Message($data['message'], $user->getId());

        // Обробка повідомлення
        $this->processMessage($message);
    }

    private function processMessage(Message $message) {
        // Логіка обробки повідомлень
        $response = "Ви надіслали: " . $message->getText();
        // Можна додати логіку для відповіді на часті питання абітурієнтів
        $this->sendResponse($response);
    }

    private function sendResponse($response) {
        // Код для надсилання відповіді через API
        echo $response;
    }
}
