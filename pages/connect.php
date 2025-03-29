<?php
$host = 'localhost';
$dbname = 'hotelsrs';
$username = 'root'; // ใช้ username ของคุณ
$password = ''; // ใช้ password ของคุณ

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}   
 
?>
  
  // CREATE DATABASE room_booking;
USE room_booking;

CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(50),
    status ENUM('available', 'full') DEFAULT 'available',
    price_per_month INT,
    price_per_day INT,
    electricity_cost INT,
    water_cost INT,
    details TEXT
); 