<?php

require '../app/config/config.php';
require '../app/controllers/ApplicantsController.php';

// Determine the requested resource
$requestUri = explode('?', $_SERVER['REQUEST_URI'])[0];
$data = json_decode(file_get_contents("php://input"), true);

if (preg_match('/^\/api\/applicants$/', $requestUri)) {
    $controller = new ApplicantsController($pdo);
    $controller->handleRequest($data);
} elseif (preg_match('/^\/api\/consultants$/', $requestUri)) {
    // Handle consultants requests
} elseif (preg_match('/^\/api\/chats$/', $requestUri)) {
    // Handle chats requests
} elseif (preg_match('/^\/api\/messages$/', $requestUri)) {
    // Handle messages requests
} elseif (preg_match('/^\/api\/faculties$/', $requestUri)) {
    // Handle faculties requests
} elseif (preg_match('/^\/api\/programs$/', $requestUri)) {
    // Handle programs requests
} elseif (preg_match('/^\/api\/applications$/', $requestUri)) {
    // Handle applications requests
} elseif (preg_match('/^\/api\/exams$/', $requestUri)) {
    // Handle exams requests
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Resource not found']);
}
