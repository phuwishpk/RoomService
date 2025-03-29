<?php
include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomId = $_POST['room_id'];
    $status = $_POST['status'];

    // อัปเดตสถานะห้องพักในฐานข้อมูล
    $stmt = $conn->prepare("UPDATE rooms SET status = ? WHERE room_id = ?");
    $stmt->bind_param("si", $status, $roomId);

    if ($stmt->execute()) {
        echo "สถานะห้องพักถูกอัปเดตสำเร็จ!";
        header("Location: status_room.php"); // ไปหน้า จัดการสถานะห้องพัก
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตสถานะห้องพัก: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $stmt->close();
    $conn->close();
}
?>
