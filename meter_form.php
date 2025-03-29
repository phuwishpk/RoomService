<?php
// เชื่อมต่อฐานข้อมูล
$conn = new mysqli("localhost", "root", "", "hotelsrs");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลห้อง + tenant + user
$sql = "SELECT 
            r.room_id, r.room_number,
            t.tenant_id, t.full_name,
            u.id AS user_id, u.username
        FROM rooms r
        LEFT JOIN tenants t ON r.room_id = t.room_id
        LEFT JOIN users u ON t.user_id = u.id
        ORDER BY r.room_number";
$result = $conn->query($sql);

// ค่าบริการต่อหน่วย
$water_rate = 18;
$electricity_rate = 7.5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meter Input</title>
    <style>
        table, th, td { border: 1px solid #ccc; border-collapse: collapse; padding: 8px; }
        input[type="number"] { width: 80px; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <h2>บันทึกหน่วยค่าน้ำ ค่าไฟ ค่าส่วนกลาง</h2>
    <form action="save_meter.php" method="post">
        <table>
            <tr>
                <th>เลขห้อง</th>
                <th>ชื่อผู้เช่า</th>
                <th>หน่วยน้ำ</th>
                <th>หน่วยไฟ</th>
                <th>ค่าน้ำ (บาท)</th>
                <th>ค่าไฟ (บาท)</th>
                <th>ค่าส่วนกลาง</th>
                <th>รวมทั้งหมด</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td class="center"><?= $row['room_number'] ?></td>
                    <td><?= $row['full_name'] ?? '-' ?></td>
                    <td><input type="number" name="water_usage[<?= $row['room_id'] ?>]" step="1" onchange="calculateTotal(this)"></td>
                    <td><input type="number" name="electricity_usage[<?= $row['room_id'] ?>]" step="1" onchange="calculateTotal(this)"></td>
                    <td><input type="number" class="water_cost" name="water_cost[<?= $row['room_id'] ?>]" readonly></td>
                    <td><input type="number" class="electric_cost" name="electric_cost[<?= $row['room_id'] ?>]" readonly></td>
                    <td><input type="number" name="common_fee[<?= $row['room_id'] ?>]" step="0.01" onchange="calculateTotal(this)"></td>
                    <td><input type="number" class="total_cost" name="total_cost[<?= $row['room_id'] ?>]" readonly></td>
                    <td class="center"><button type="submit" name="edit" value="<?= $row['room_id'] ?>">Edit</button></td>
                    <td class="center"><button type="submit" name="delete" value="<?= $row['room_id'] ?>">Delete</button></td>
                </tr>
            <?php endwhile; ?>

        </table>
    </form>

    <script>
        const waterRate = <?= $water_rate ?>;
        const electricRate = <?= $electricity_rate ?>;

        function calculateTotal(input) {
            const row = input.parentElement.parentElement;
            const waterInput = row.querySelector('input[name^="water_usage"]');
            const electricInput = row.querySelector('input[name^="electricity_usage"]');
            const commonInput = row.querySelector('input[name^="common_fee"]');

            const waterCost = row.querySelector('.water_cost');
            const electricCost = row.querySelector('.electric_cost');
            const totalCost = row.querySelector('.total_cost');

            const water = parseFloat(waterInput?.value) || 0;
            const electric = parseFloat(electricInput?.value) || 0;
            const common = parseFloat(commonInput?.value) || 0;

            const wCost = water * waterRate;
            const eCost = electric * electricRate;
            const total = wCost + eCost + common;

            waterCost.value = wCost.toFixed(2);
            electricCost.value = eCost.toFixed(2);
            totalCost.value = total.toFixed(2);
        }
    </script>
    <button onclick="window.location.href='dashboardadmin.php'" style="padding: 8px 16px; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer;">

</button>
</body>
</html>
