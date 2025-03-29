<?php
include('../dbconnect.php');

$result = $conn->query("SELECT b.id, r.room_number, b.start_date, b.monthly_rent FROM bookings b JOIN rooms r ON b.room_id = r.room_id");

echo "<h2>รายการการจองทั้งหมด</h2>";
echo "<table border='1'>
        <tr>
            <th>หมายเลขห้อง</th>
            <th>วันที่เริ่ม</th>
            <th>ระยะเวลาสัญญา</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['room_number']}</td>
            <td>{$row['start_date']}</td>
            <td>{$row['monthly_rent']} เดือน</td>
          </tr>";
}

echo "</table>";
?>
