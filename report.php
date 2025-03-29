<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การออกรายงาน</title>
    <link rel="stylesheet" href="styles1.css">
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
        <!-- เมนูด้านซ้าย -->
        <nav class="sidebar">
            <h3>Menu</h3>
            <ul>
                <li><a href="dashboardadmin.php">การจัดการห้องพัก</a></li>
                <li><a href="booking.php">การจองและทำสัญญาเช่า</a></li>
                <li><a href="Tenant_move-out.php">การรับผู้เข้าพักและขาออก</a></li>
                <li><a href="Tenant_management.php">การจัดการผู้เช่า</a></li>
                <li><a href="service.php">การจัดเก็บค่าเช่าและค่าบริการ</a></li>
                <li><a href="report.php" class="active">การออกรายงาน</a></li>
            </ul>
        </nav>

        <!-- เนื้อหาหลัก -->
        <main class="content">
            <h2>การออกรายงาน</h2>
            <form id="reportForm">
                <div class="form-group">
                    <label for="reportType">ประเภทของรายงาน:</label>
                    <select id="reportType" name="reportType">
                        <option value="booking">รายงานการจอง</option>
                        <option value="checkin">รายงานการเข้าพัก</option>
                        <option value="payment">รายงานการชำระเงิน</option>
                        <option value="roomStatus">รายงานสถานะห้องพัก</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="startDate">วันที่เริ่มต้น:</label>
                    <input type="date" id="startDate" name="startDate" required>
                </div>
                <div class="form-group">
                    <label for="endDate">วันที่สิ้นสุด:</label>
                    <input type="date" id="endDate" name="endDate" required>
                </div>
                <button type="submit">สร้างรายงาน</button>
            </form>
            <div id="reportResult">
                <!-- ผลลัพธ์ของรายงานจะแสดงที่นี่ -->
            </div>
        </main>
    </div>
    <script src="scripts2.js"></script>
</body>
</html>
