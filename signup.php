<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body class="signup-page">

    <div class="signup-container">
        <h2>สมัครสมาชิก</h2>
        <form id="signupForm">
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input type="email" id="email" placeholder="กรอกอีเมลของคุณ" required>
            </div>

            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input type="password" id="password" placeholder="กรอกรหัสผ่าน" required>
            </div>

            <div class="form-group">
                <label for="confirmPassword">ยืนยันรหัสผ่าน</label>
                <input type="password" id="confirmPassword" placeholder="ยืนยันรหัสผ่าน" required>
            </div>

            <button type="submit" class="signup-btn">สมัครสมาชิก</button>
        </form>

        <p>มีบัญชีแล้ว? <a href="login.html">เข้าสู่ระบบ</a></p>
    </div>

    <script src="signup.js"></script>
</body>
</html>
