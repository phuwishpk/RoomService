<?php
// send_message.php
include 'config.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_message'])) {
    $user_message = $_POST['user_message'];
    $response = send_message($conn, $user_message);
    echo $response;
} else {
    echo "ไม่มีข้อความ";
}

$conn->close();
?>
