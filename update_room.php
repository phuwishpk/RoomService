<?php
include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $roomId = $_POST['room_id'];
    $roomNumber = $_POST['room_number'];
    $roomPrice = $_POST['room_price'];
    $roomStatus = $_POST['room_status'];

    // อัปเดตข้อมูลห้องพักในฐานข้อมูล
    $stmt = $conn->prepare("UPDATE rooms SET room_number = ?, price = ?, status = ? WHERE room_id = ?");
    $stmt->bind_param("sssi", $roomNumber, $roomPrice, $roomStatus, $roomId);

    if ($stmt->execute()) {
        echo "ข้อมูลห้องพักถูกอัปเดตสำเร็จ!";
        header("Location: index.php"); // ไปหน้า Dashboard
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูลห้องพัก: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $stmt->close();
    $conn->close();
}
?>
