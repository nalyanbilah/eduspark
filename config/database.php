<?php
try {
    $host = 'localhost';
    $dbname = 'eduspark';  // Your database name
    $username = 'root';    // Your database username
    $password = '';        // Your database password

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>