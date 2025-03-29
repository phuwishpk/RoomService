<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการห้องพัก</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">Hotel</div>
        <div class="admin-info" onclick="goToAdminPage()">
            <img src="admin.jpg" alt="Admin">
            <span>Admin</span>
        </div>
    
        <script>
            function goToAdminPage() {
                window.location.href = "admin.php"; // ไปยังหน้าข้อมูล Admin
            }
        </script>
    </header>
    <div class="container">
        <nav class="sidebar">
            <h3>Menu</h3>
            <ul>
                <li><a href="dashboardadmin.php" class="active">การจัดการห้องพัก</a></li>
                <li><a href="booking.php">การจองและทำสัญญาเช่า</a></li>
                <li><a href="Tenant_move-out.php">การรับผู้เข้าพักและขาออก</a></li>
                <li><a href="Tenant_management.php">การจัดการผู้เช่า</a></li>
                <li><a href="service.php">การจัดเก็บค่าเช่าและค่าบริการ</a></li>
                <li><a href="report.php">การออกรายงาน</a></li>
            </ul>
        </nav>
        <main>
            <h1>WELCOME ADMIN</h1>
            <div class="buttons">
                <button class="rounded-button" onclick="window.location='add_room.html'">การเพิ่มห้องพัก</button>
                <button class="rounded-button" onclick="window.location='edit_room.php'">การแก้ไขข้อมูลห้องพัก</button>
                <button class="rounded-button" onclick="window.location='status_room.php'">การจัดการสถานะห้องพัก</button>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; 2025 Hotel Management System. All rights reserved.</p>
    </footer>
</body>
</html>
