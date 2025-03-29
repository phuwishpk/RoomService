<?php
session_start();
include('dbconnect.php');

header("Content-Type: application/json"); // ให้ PHP ส่ง JSON response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["pass_word"] ?? "";

    if (empty($username) || empty($password)) {
        echo json_encode(["success" => false, "message" => "❌ กรุณากรอกชื่อผู้ใช้และรหัสผ่านให้ครบ"]);
        exit();
    }

    // ค้นหาข้อมูลจากฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $row["pass_word"])) {
            $_SESSION['username'] = $username;

            echo json_encode(["success" => true, "redirect" => "index.html"]);
        } else {
            echo json_encode(["success" => false, "message" => "❌ รหัสผ่านไม่ถูกต้อง!"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "❌ ไม่พบชื่อผู้ใช้!"]);
    }

    $stmt->close();
    $conn->close();
}
?>
