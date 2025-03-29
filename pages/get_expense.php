<?php
// get_expenses.php
include 'config.php';
include 'functions.php';

// ดึงข้อมูลค่าน้ำ ค่าไฟ ค่าส่วนกลางจากฐานข้อมูล
$expenses = get_expenses($conn);

// ส่งข้อมูลในรูปแบบ JSON
echo json_encode($expenses);

$conn->close();
?>
