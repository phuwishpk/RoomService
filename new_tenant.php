<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $id_card_or_passport = isset($_POST['id_card_or_passport']) ? trim($_POST['id_card_or_passport']) : '';
    $birth_date = isset($_POST['birth_date']) ? trim($_POST['birth_date']) : '';
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $nationality = isset($_POST['nationality']) ? trim($_POST['nationality']) : '';
    $contact_info = isset($_POST['contact_info']) ? trim($_POST['contact_info']) : '';
    $current_address = isset($_POST['current_address']) ? trim($_POST['current_address']) : '';
    $email = !empty($_POST['email']) ? trim($_POST['email']) : NULL;
    $additional_info = isset($_POST['additional_info']) ? trim($_POST['additional_info']) : '';
    $vehicle_info = isset($_POST['vehicle_info']) ? trim($_POST['vehicle_info']) : '';
    $marital_status = isset($_POST['marital_status']) ? strtolower(trim($_POST['marital_status'])) : '';
    $emergency_contact = isset($_POST['emergency_contact']) ? trim($_POST['emergency_contact']) : '';
    $room_id = isset($_POST['room_id']) ? intval($_POST['room_id']) : 0;

    // เช็คว่าได้เลือกห้องหรือไม่
    if ($room_id === 0) {
        die("กรุณาเลือกห้องพัก");
    }

    // ตรวจสอบให้แน่ใจว่าค่าของ full_name ไม่เป็นค่าว่าง
    if (empty($full_name)) {
        die("กรุณากรอกชื่อเต็ม");
    }

    // ✅ ตรวจสอบค่า marital_status ให้ตรงกับ ENUM
    $allowed_statuses = ['single', 'married', 'divorced', 'widowed'];
    if (!in_array($marital_status, $allowed_statuses)) {
    $marital_status = 'single'; // ตั้งค่าเริ่มต้น
    }

    // ตรวจสอบค่า gender ว่าเป็นค่า ENUM ที่ยอมรับได้
    $allowed_genders = ['male', 'female', 'other'];
    if (!in_array($gender, $allowed_genders)) {
        die("ค่าของเพศไม่ถูกต้อง กรุณาเลือก 'male', 'female', หรือ 'other'");
    }

    // ✅ 1. เพิ่มข้อมูลในตาราง tenants
    $sql1 = "INSERT INTO tenants (full_name, phone, id_card) VALUES (?, ?, ?)";
    $stmt1 = $conn->prepare($sql1);
    if ($stmt1 === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // กำหนดตัวแปรให้ตรงตามพารามิเตอร์
    $stmt1->bind_param("sss", $full_name, $phone, $id_card_or_passport);

    if ($stmt1->execute()) {
        $tenant_id = $stmt1->insert_id; // ดึงค่า ID ล่าสุดของผู้เช่า
        $stmt1->close();

        // ✅ 2. เพิ่มข้อมูลลง tenant_details
        $sql2 = "INSERT INTO tenant_details 
                 (tenant_id, birth_date, gender, nationality, id_card_or_passport, contact_info, current_address, phone, email, additional_info, vehicle_info, marital_status, emergency_contact) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sql2);
        if ($stmt2 === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // ตรวจสอบให้แน่ใจว่าทุกตัวแปรถูกกำหนด
        $stmt2->bind_param("issssssssssss", 
            $tenant_id, $birth_date, $gender, $nationality, 
            $id_card_or_passport, $contact_info, $current_address, 
            $phone, $email, $additional_info, $vehicle_info, 
            $marital_status, $emergency_contact
        );

        if ($stmt2->execute()) {
            $stmt2->close();

            // ✅ 3. อัปเดตข้อมูลห้องพักในตาราง rooms
            $sql3 = "UPDATE rooms SET tenant_id = ? WHERE room_id = ?";
            $stmt3 = $conn->prepare($sql3);
            if ($stmt3 === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt3->bind_param("ii", $tenant_id, $room_id);
            if ($stmt3->execute()) {
                header("Location: index.php");
                //echo "บันทึกข้อมูลสำเร็จ!";
            } else {
                echo "เกิดข้อผิดพลาดในการอัปเดตห้องพัก: " . htmlspecialchars($stmt3->error);
            }
            $stmt3->close();

            // ✅ 4. อัปเดตสถานะในตาราง booking ให้เป็น "ไม่ว่าง"
            $sql4 = "UPDATE booking SET status = 'occupied' WHERE room_id = ?";
            $stmt4 = $conn->prepare($sql4);
            if ($stmt4 === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt4->bind_param("i", $room_id);
            if (!$stmt4->execute()) {
                echo "เกิดข้อผิดพลาดในการอัปเดตสถานะการจอง: " . htmlspecialchars($stmt4->error);
            }
            $stmt4->close();

        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลรายละเอียดผู้เช่า: " . htmlspecialchars($stmt2->error);
        }
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลผู้เช่า: " . htmlspecialchars($stmt1->error);
    }

    $conn->close();
}
?>
