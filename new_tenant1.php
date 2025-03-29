<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนผู้เช่า</title>
    <link rel="stylesheet" href="./new_tenant.css">
</head>
<body>
    <div class="container">
        <h2>ลงทะเบียนผู้เช่า</h2>
        <form action="new_tenant.php" method="POST">
            <label for="full_name">ชื่อ-นามสกุล:</label>
            <input type="text" name="full_name" id="full_name" required>

            <label for="birth_date">วันเดือนปีเกิด:</label>
            <input type="date" name="birth_date" id="birth_date" required>

            <label for="gender">เพศ:</label>
            <select name="gender" id="gender" required>
                <option value="">เลือกเพศ</option>
                <option value="male">ชาย</option>
                <option value="female">หญิง</option>
                <option value="other">อื่น ๆ</option>
            </select>

            <label for="nationality">สัญชาติ:</label>
            <input type="text" name="nationality" id="nationality" required>

            <label for="id_card_or_passport">หมายเลขบัตรประชาชน/หนังสือเดินทาง:</label>
            <input type="text" name="id_card_or_passport" id="id_card_or_passport" required>

            <label for="contact_info">ข้อมูลติดต่อ:</label>
            <textarea name="contact_info" id="contact_info" required></textarea>

            <label for="current_address">ที่อยู่ปัจจุบัน:</label>
            <textarea name="current_address" id="current_address" required></textarea>

            <label for="phone">เบอร์โทรศัพท์:</label>
            <input type="text" name="phone" id="phone" required>

            <label for="email">อีเมลล์:</label>
            <input type="email" name="email" id="email" required>

            <label for="additional_info">ข้อมูลเพิ่มเติม:</label>
            <textarea name="additional_info" id="additional_info"></textarea>

            <label for="vehicle_info">ยานพาหนะ:</label>
            <textarea name="vehicle_info" id="vehicle_info"></textarea>

            <label for="marital_status">สถานภาพสมรส:</label>
            <select name="marital_status" id="marital_status">
                <option value="โสด">โสด</option>
                <option value="สมรส">สมรส</option>
                <option value="หย่าร้าง">หย่าร้าง</option>
                <option value="อื่น ๆ">อื่น ๆ</option>
            </select>

            <label for="emergency_contact">บุคคลที่ติดต่อฉุกเฉิน:</label>
            <textarea name="emergency_contact" id="emergency_contact" required></textarea>

            <!-- ส่วนเลือกห้องพัก -->
            <label>เลือกห้องพัก:</label>
            <select name="room_id" required>
                <option value="">-- เลือกห้องพัก --</option>
                <?php
                include 'dbconnect.php'; 
                
                $sql = "SELECT room_id, room_number FROM rooms WHERE tenant_id IS NULL"; // ดึงห้องที่ยังไม่มีผู้เช่า
                $result = $conn->query($sql);
                
                if (!$result) {
                    die("เกิดข้อผิดพลาดในการดึงข้อมูลห้อง: " . $conn->error);
                }
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['room_id']) . "'>" . htmlspecialchars($row['room_number']) . "</option>";
                    }
                } else {
                    echo "<option value=''>ไม่มีห้องพักให้เลือก</option>";
                }
                
                $conn->close();
                ?>
            </select>
            

            <button type="submit">บันทึกข้อมูล</button>
        </form>
    </div>
</body>
</html>
