<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดเก็บค่าเช่าและค่าบริการ</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="service.css">
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
        <!-- เมนูด้านซ้าย -->
        <nav class="sidebar">
            <h3>Menu</h3>
            <ul>
                <li><a href="dashboardadmin.php">การจัดการห้องพัก</a></li>
                <li><a href="booking.php">การจองและทำสัญญาเช่า</a></li>
                <li><a href="Tenant_move-out.php">การรับผู้เข้าพักและขาออก</a></li>
                <li><a href="Tenant_management.php">การจัดการผู้เช่า</a></li>
                <li><a href="service.php" class="active">การจัดเก็บค่าเช่าและค่าบริการ</a></li>
                <li><a href="report.php">การออกรายงาน</a></li>
            </ul>
        </nav>

        <!-- เนื้อหาหลัก -->
        <main class="content">
            <header>
                <h2>การจัดเก็บค่าเช่าและค่าบริการ</h2>
            </header>

            <section class="booking-list">
                <table>
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>ห้องพักที่อยู่</th>
                            <th>ค่าน้ำ-ค่าไฟ</th>
                            <th>วันครบรอบชำระ</th>
                            <th>ชำระเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td class="room-status"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="payment-status"></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2025 Hotel Management System. All rights reserved.</p>
    </footer>

    <script src="script1.js"></script>
</body>
</html>
