<?php
$servername = "localhost";
$username = "root";  
$password = "";     
$dbname = "hotelsrs"; 

// เชื่อมต่อ MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}
?>
