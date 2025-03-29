<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูล Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-page">
        <h2>ข้อมูลผู้ดูแลระบบ</h2>
        <p>ยังไม่มีข้อมูลในขณะนี้</p>
        <button class="logout-btn" onclick="logout()">ออกจากระบบ</button>
    </div>

    <script>
        function logout() {
            window.location.href = "login.html"; // กลับไปหน้าล็อกอิน
        }
    </script>
</body>
</html>
