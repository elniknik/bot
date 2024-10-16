 <?php
require '../vendor/autoload.php';

use App\Controllers\BotController;

$config = require '../config/config.php';

$data = [
    'user_id' => $_POST['user_id'] ?? '1',
    'user_name' => $_POST['user_name'] ?? 'Guest',
    'message' => $_POST['message'] ?? 'Привіт!',
];

$controller = new BotController();
$controller->handleRequest($data);
