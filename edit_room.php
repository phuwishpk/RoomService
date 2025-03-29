<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลห้องพัก</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="edit_room.css"> <!-- CSS สำหรับหน้านี้ -->
</head>
<body>

    <header>
        <h2>แก้ไขข้อมูลห้องพัก</h2>
        <a href="index.html" class="back-button">กลับสู่หน้าหลัก</a>
    </header>

    <main>
        <section class="room-list">
            <h3>รายการห้องพัก</h3>
            <table>
                <thead>
                    <tr>
                        <th>ชื่อห้อง</th>
                        <th>ราคา</th>
                        <th>สถานะ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
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
                                    <td>" . $row['status'] . "</td>
                                    <td><a href='edit_room.php?id=" . $row['room_id'] . "'><button class='edit-btn'>แก้ไข</button></a></td>
                                    <td><a href='delete_room.php?id=" . $row['room_id'] . "'><button class='delete-btn'>ลบ</button></a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>ไม่มีห้องพัก</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>

        <?php
        // ถ้ามีการส่ง id ห้องมาจาก URL ให้ทำการดึงข้อมูลห้องนั้นมาแสดง
        if (isset($_GET['id'])) {
            include('dbconnect.php');
            $roomId = $_GET['id'];
            $sql = "SELECT * FROM rooms WHERE room_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $roomId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>

                <section class="edit-form">
                    <h3>แก้ไขห้องพัก</h3>
                    <form action="update_room.php" method="post">
                        <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">

                        <label>ชื่อห้องพัก:</label>
                        <input type="text" name="room_number" value="<?php echo $row['room_number']; ?>" required>

                        <label>ราคา:</label>
                        <input type="number" name="room_price" value="<?php echo $row['price']; ?>" required>

                        <label>สถานะห้อง:</label>
                        <select name="room_status" required>
                            <option value="available" <?php echo $row['status'] == 'available' ? 'selected' : ''; ?>>ว่าง</option>
                            <option value="unavailable" <?php echo $row['status'] == 'unavailable' ? 'selected' : ''; ?>>มีผู้เช่า</option>
                            <option value="maintenance" <?php echo $row['status'] == 'maintenance' ? 'selected' : ''; ?>>ซ่อมบำรุง</option>
                        </select>

                        <button type="submit" class="save-btn">บันทึกการเปลี่ยนแปลง</button>
                    </form>
                    <a href="index.php" class="back-button">ย้อนกลับ</a>
                </section>

                <?php
            } else {
                echo "ไม่พบข้อมูลห้องพัก";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </main>
        
    <script src="script.js"></script>
</body>
</html>
