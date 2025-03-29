<?php
include('../dbconnect.php');

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบการส่งข้อมูลจาก POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $room_id = $_POST['room_id'];
    $start_date = $_POST['start_date'];
    $monthly_rent = $_POST['monthly_rent'];
    $username = $_POST['username'];  // รับจาก localStorage

    // ตรวจสอบว่าเลือกห้องไหม
    if (empty($room_id) || empty($start_date) || empty($monthly_rent)) {
        echo json_encode(['success' => false, 'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน']);
        exit();
    }

    // ค้นหาผู้ใช้งานจากชื่อผู้ใช้
    $stmt = $conn->prepare("SELECT tenant_id FROM tenants WHERE username = ?");
    if ($stmt === false) {
        die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error);
    }

    $stmt->bind_param("s", $username); // ใช้ username
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $tenant = $result->fetch_assoc();
        $tenant_id = $tenant['tenant_id'];

        // บันทึกข้อมูลการจองห้อง
        $stmt = $conn->prepare("INSERT INTO contracts (tenant_id, room_id, start_date, monthly_rent, status) VALUES (?, ?, ?, ?, 'active')");
        if ($stmt === false) {
            die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL สำหรับการบันทึกข้อมูล: " . $conn->error);
        }

        $stmt->bind_param("iisi", $tenant_id, $room_id, $start_date, $monthly_rent);

        if ($stmt->execute()) {
            // อัปเดตสถานะห้องเป็น 'unavailable' หลังจอง
            $stmt = $conn->prepare("UPDATE rooms SET status = 'unavailable' WHERE room_id = ?");
            $stmt->bind_param("i", $room_id);
            $stmt->execute();
            
            echo json_encode(['success' => true, 'message' => 'การจองสำเร็จ']);
        } else {
            echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ไม่พบผู้ใช้งานในระบบ']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลที่ส่งมา']);
}
?>