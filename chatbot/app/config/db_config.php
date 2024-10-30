<?php
$host = 'localhost';
$db = 'admissions_bot';
$user = 'root'; // your MySQL username
$pass = '';     // your MySQL password
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; // Optional: This line can be used for testing
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
