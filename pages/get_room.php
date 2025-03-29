<?php
header('Content-Type: application/json');
include('../dbconnect.php'); // เชื่อมต่อกับฐานข้อมูล

$query = "SELECT room_number, status_ FROM rooms"; // ดึงข้อมูลห้องจากฐานข้อมูล
$result = $conn->query($query);

$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms); // ส่งข้อมูลเป็น JSON
?>
