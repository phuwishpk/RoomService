<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการสถานะห้องพัก</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="status_room.css">
</head>
<body>

    <header>
        <h2>จัดการสถานะห้องพัก</h2>
        <a href="index.html" class="back-button">กลับสู่หน้าหลัก</a>
    </header>

    <main>
        <section class="room-status-list">
            <h3>รายการห้องพัก</h3>
            <table>
                <thead>
                    <tr>
                        <th>ชื่อห้อง</th>
                        <th>ราคา</th>
                        <th>สถานะ</th>
                        <th>เปลี่ยนสถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('dbconnect.php');
                    $sql = "SELECT * FROM rooms";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['room_number'] . "</td>
                                    <td>" . $row['price'] . " บาท/เดือน</td>
                                    <td class='room-status'>" . $row['status'] . "</td>
                                    <td>
                                        <form action='update_status.php' method='POST'>
                                            <input type='hidden' name='room_id' value='" . $row['room_id'] . "'>
                                            <select name='status'>
                                                <option value='available' " . ($row['status'] == 'available' ? 'selected' : '') . ">ว่าง</option>
                                                <option value='unavailable' " . ($row['status'] == 'unavailable' ? 'selected' : '') . ">มีผู้เช่า</option>
                                                <option value='maintenance' " . ($row['status'] == 'maintenance' ? 'selected' : '') . ">กำลังทำความสะอาด</option>
                                            </select>
                                            <button type='submit' class='update-status-btn'>อัปเดต</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>ไม่มีห้องพัก</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
        <a href="index.php" class="back-button">ย้อนกลับ</a>
    </main>

    <script src="script.js"></script>
</body>
</html>
