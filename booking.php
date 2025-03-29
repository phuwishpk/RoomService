<?php
include('dbconnect.php');



// ดึงข้อมูลห้องพักจากฐานข้อมูล พร้อมชื่อและเบอร์โทรผู้เช่า

$sql = "

SELECT r.room_number, r.status, t.full_name AS tenant_name, t.phone AS tenant_phone

FROM rooms r
    LEFT JOIN tenants t ON r.tenant_id = t.tenant_id
    ORDER BY r.room_number ASC
";

// ดำเนินการ SQL
$result = $conn->query($sql);
if ($result === false) {
    die("เกิดข้อผิดพลาดในการดึงข้อมูล: " . htmlspecialchars($conn->error));
}

// Mapping สถานะห้อง
$status_mapping = [
    'available' => 'ว่าง',
    'unavailable' => 'มีผู้เช่า',
    'maintenance' => 'กำลังทำความสะอาด'
];

// จัดกลุ่มห้องตามหลักร้อย (101-105, 201-205, 301-305)
$room_groups = [];

// จัดกลุ่มห้องเป็น array ตามช่วงหลักร้อย
while ($row = $result->fetch_assoc()) {
    $group = floor($row['room_number'] / 100) * 100; // ได้กลุ่ม 100, 200, 300, ...
    $room_groups[$group][] = $row;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจองและทำสัญญาเช่า</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="booking.css">
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
    <nav class="sidebar">
        <h3>Menu</h3>
        <ul>
            <li><a href="dashboardadmin.php">การจัดการห้องพัก</a></li>
            <li><a href="booking.php" class="active">การจองและทำสัญญาเช่า</a></li>
            <li><a href="Tenant_move-out.php">การรับผู้เข้าพักและขาออก</a></li>
            <li><a href="Tenant_management.php">การจัดการผู้เช่า</a></li>
            <li><a href="service.php">การจัดเก็บค่าเช่าและค่าบริการ</a></li>
            <li><a href="report.php">การออกรายงาน</a></li>
        </ul>
    </nav>

    <main class="content">
        <header>
            <h2>การจองห้องพักและการทำสัญญาเช่า</h2>
            <input type="text" id="search-room" placeholder="ค้นหาห้องพัก...">
        </header>

        <?php foreach ($room_groups as $group => $rooms): ?>
            <section class="booking-list">
                <h3>ห้องพัก <?= $group ?> - <?= $group + 5 ?></h3>
                <table>
                    <thead>
                        <tr>
                            <th>ห้องพัก</th>
                            <th>สถานะห้อง</th>
                            <th>ชื่อ</th>
                            <th>เบอร์</th>
                            <th>จอง / ทำสัญญา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rooms as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['room_number']) ?></td>
                                <td class='room-status'><?= $status_mapping[$row['status']] ?></td>
                                <td><?= !empty($row['tenant_name']) ? htmlspecialchars($row['tenant_name']) : "-" ?></td>
                                <td><?= !empty($row['tenant_phone']) ? htmlspecialchars($row['tenant_phone']) : "-" ?></td>
                                <td>
                                    <?php if ($row['status'] == 'available'): ?>
                                        <button class='booking-btn'>จอง</button>
                                    <?php elseif ($row['status'] == 'unavailable'): ?>
                                        <button class='contract-btn'>ทำสัญญา</button>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endforeach; ?>

    </main>
</div>

<footer>
    <p>&copy; 2025 Hotel Management System. All rights reserved.</p>
</footer>

<script src="script1.js"></script>
</body>
</html>

<?php $conn->close(); ?>
