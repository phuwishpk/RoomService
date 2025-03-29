<?php
include('dbconnect.php');

// ตรวจสอบว่าได้ส่งข้อมูลมาใน POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลจากฟอร์ม
    $roomNumber = $_POST['room-number'];
    $roomType = $_POST['room-type'];
    $roomPrice = $_POST['room-price'];
    $roomStatus = $_POST['room-status'];

    // บันทึกข้อมูลห้องพักลงในฐานข้อมูล
    $stmt = $conn->prepare("INSERT INTO  room_id (room_number, type, price, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $roomNumber, $roomType, $roomPrice, $roomStatus);

    if ($stmt->execute()) {
        echo "ห้องพักถูกเพิ่มสำเร็จ!";
        header("Location: index.php"); // ไปหน้า Dashboard
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูลห้องพัก: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $stmt->close();
    $conn->close();
}
?>
