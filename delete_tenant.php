<?php
include 'dbconnect.php';

if (isset($_GET['id'])) {
    $tenant_id = intval($_GET['id']);

    // ลบข้อมูลในตาราง tenant_details
    $sql1 = "DELETE FROM tenant_details WHERE tenant_id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $tenant_id);
    $stmt1->execute();

    // ลบข้อมูลในตาราง tenants
    $sql2 = "DELETE FROM tenants WHERE tenant_id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $tenant_id);
    $stmt2->execute();

    // ปิดการเชื่อมต่อ
    $stmt1->close();
    $stmt2->close();
    $conn->close();

    // กลับไปยังหน้าจัดการผู้เช่า
    header("Location: Tenant_management.php?message=ลบผู้เช่าสำเร็จ");
    exit;
} else {
    echo "ไม่พบผู้เช่า";
}
?>
