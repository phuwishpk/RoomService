<?php
include 'dbconnect.php';

$sql = "SELECT tenants.id, tenants.name, tenants.phone, 
               tenant_details.birth_date, tenant_details.gender, 
               tenant_details.nationality, tenant_details.id_card_or_passport, 
               tenant_details.current_address, tenant_details.email, 
               tenant_details.vehicle_info, tenant_details.marital_status, 
               tenant_details.emergency_contact, rooms.room_number 
        FROM tenants 
        JOIN tenant_details ON tenants.id = tenant_details.tenant_id
        LEFT JOIN rooms ON tenants.id = rooms.tenant_id";  // เชื่อมกับตาราง rooms เพื่อนำหมายเลขห้อง

$result = $conn->query($sql);
?>

<table>
    <thead>
        <tr>
            <th>ชื่อ</th>
            <th>วันเกิด</th>
            <th>เพศ</th>
            <th>สัญชาติ</th>
            <th>บัตรประชาชน/พาสปอร์ต</th>
            <th>ที่อยู่</th>
            <th>อีเมล</th>
            <th>ยานพาหนะ</th>
            <th>สถานภาพสมรส</th>
            <th>ติดต่อฉุกเฉิน</th>
            <th>ห้องพัก</th>  <!-- เพิ่มคอลัมน์ห้องพัก -->
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['birth_date'] ?></td>
                <td><?= $row['gender'] ?></td>
                <td><?= $row['nationality'] ?></td>
                <td><?= $row['id_card_or_passport'] ?></td>
                <td><?= $row['current_address'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['vehicle_info'] ?></td>
                <td><?= $row['marital_status'] ?></td>
                <td><?= $row['emergency_contact'] ?></td>
                <td><?= $row['room_number'] ? $row['room_number'] : 'ยังไม่มีห้องพัก' ?></td> 
                <!-- ถ้าไม่มีห้อง จะแสดง "ยังไม่มีห้องพัก" -->
            </tr>
        <?php } ?>
    </tbody>
</table>
