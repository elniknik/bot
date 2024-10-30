 <?php
//use app\controllers\BotController;
require_once 'app/controllers/BotController.php';
$config = require 'config/config.php';

$data = [
    'user_id' => $_POST['user_id'] ?? '1',
    'user_name' => $_POST['user_name'] ?? 'Guest',
    'message' => $_POST['message'] ?? 'Привіт!',
];

$controller = new app\controllers\BotController();
$controller->handleRequest($data);
