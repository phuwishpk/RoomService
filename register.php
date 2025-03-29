<?php
include 'dbconnect.php'; // รวมไฟล์ dbconnect.php เพื่อเชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $idCard = $_POST['id_card'];
    $contactInfo = $_POST['contact_info'];
    $address = $_POST['ad_dress']; // แก้ชื่อให้ตรงกับชื่อฟิลด์
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $emergencyPhone = $_POST['emergency_phone'];
    $vehicle = $_POST['vehicle'];
    $maritalStatus = $_POST['marital_status'];
    $password = password_hash($_POST['pass_word'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, gender, nationality, id_card, contact_info, ad_dress, email, phone, emergency_phone, vehicle, marital_status, pass_word) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // ผูกพารามิเตอร์
    $stmt->bind_param("ssssssssssssss", $firstName, $lastName, $username, $gender, $nationality, $idCard, $contactInfo, $address, $email, $phone, $emergencyPhone, $vehicle, $maritalStatus, $password);

    // ดำเนินการคำสั่ง
    if ($stmt->execute()) {
        echo "สมัครสมาชิกสำเร็จ!";
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error; // ใช้ $stmt->error เพื่อดูข้อผิดพลาด
    }

    // ปิด statement
    $stmt->close();
}
?>
