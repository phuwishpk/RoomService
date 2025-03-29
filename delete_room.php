<?php
include('dbconnect.php');

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    // ลบห้องพักจากฐานข้อมูล
    $stmt = $conn->prepare("DELETE FROM rooms WHERE room_id = ?");
    $stmt->bind_param("i", $roomId);

    if ($stmt->execute()) {
        echo "ห้องพักถูกลบสำเร็จ!";
        header("Location: index.php"); // ไปหน้า Dashboard
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการลบห้องพัก: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $stmt->close();
    $conn->close();
}
?>
