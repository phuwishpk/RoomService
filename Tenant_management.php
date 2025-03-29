<?php
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการผู้เช่า</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="Tenant_management.css">
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
                window.location.href = "admin.php";
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
                <li><a href="Tenant_management.php" class="active">การจัดการผู้เช่า</a></li>
                <li><a href="service.php">การจัดเก็บค่าเช่าและค่าบริการ</a></li>
                <li><a href="report.php">การออกรายงาน</a></li>
            </ul>
        </nav>

        <!-- เนื้อหาหลัก -->
        <main class="content">
            <header>
                <h2>การจัดการผู้เช่า</h2>
            </header>

            <section class="booking-list">
                <table>
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>เพศ</th>
                            <th>สัญชาติ</th>
                            <th>รหัสบัตรประชาชน</th>
                            <th>ที่อยู่</th>
                            <th>อีเมล</th>
                            <th>เบอร์โทร</th>
                            <th>เบอร์ฉุกเฉิน</th>
                            <th>ยานพาหนะ</th>
                            <th>สถานะสมรส</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, first_name, last_name, username, gender, nationality, 
                                       id_card, ad_dress, email, phone, emergency_phone, 
                                       vehicle, marital_status
                                FROM users";

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $index = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$index}</td>
                                    <td>{$row['first_name']} {$row['last_name']}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['gender']}</td>
                                    <td>{$row['nationality']}</td>
                                    <td>{$row['id_card']}</td>
                                    <td>{$row['ad_dress']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['emergency_phone']}</td>
                                    <td>{$row['vehicle']}</td>
                                    <td>{$row['marital_status']}</td>
                                    <td>
                                        <button onclick=\"confirmDelete({$row['id']})\">ลบ</button>
                                    </td>
                                </tr>";
                                $index++;
                            }
                        } else {
                            echo "<tr><td colspan='13'>ไม่มีข้อมูลผู้เช่า</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2025 Hotel Management System. All rights reserved.</p>
    </footer>

    <script>
        function confirmDelete(userId) {
            if (confirm("คุณแน่ใจว่าต้องการลบผู้ใช้นี้?")) {
                window.location.href = "delete_user.php?id=" + userId;
            }
        }
    </script>
</body>
</html>
