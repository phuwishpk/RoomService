<?php
// เชื่อมต่อกับฐานข้อมูล MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotelsrs"; // ชื่อฐานข้อมูลที่ใช้

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลสถานะห้อง
$sql = "SELECT room_number, status_ FROM rooms WHERE room_number IN (101, 102, 103, 104, 105)";
$result = $conn->query($sql);

$rooms = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
    // ส่งข้อมูลกลับในรูปแบบ JSON
    echo json_encode($rooms);
} else {
    echo json_encode(array('error' => 'No data found'));
}

// ตรวจสอบว่ามีข้อมูลจากฐานข้อมูลหรือไม่
echo "Hello, this is test."; // เพิ่มการทดสอบ


$conn->close();
?>
