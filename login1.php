<?php
include('dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    if (empty($username) || empty($password)) {
        die("❌ กรุณากรอกชื่อผู้ใช้และรหัสผ่านให้ครบ");
    }

    // ค้นหาข้อมูลจากฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM singin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // ตรวจสอบรหัสผ่าน
        if ($password == $row["password"]) {  // เปรียบเทียบรหัสผ่านแบบธรรมดา
            echo "✅ เข้าสู่ระบบสำเร็จ!";
            header("Location: dashboardadmin.php"); // ไปหน้า Dashboard
            exit();
        } else {
            echo "❌ รหัสผ่านไม่ถูกต้อง!";
        }
    } else {
        echo "❌ ไม่พบชื่อผู้ใช้!";
    }

    $stmt->close();
    $conn->close();
}
?>
