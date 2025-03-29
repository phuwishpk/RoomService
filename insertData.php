<?php
//เชื่อมต่อฐานข้อมูล
require('dbconnect.php');


//รับค่า
$username=$_POST["username"];
$pass=$_POST["pass"];


//บันทึกข้อมูล
$sql = "INSERT INTO singin(username, ) VALUES('$username','$pass')";

$result=mysqli_query($connect,$sql); // สั่งรันคำสั่ง sql

if($result){
    header("location:login.php");
    exit(0);
}else{
    echo "Error: " . mysqli_error($conn);
}

?>
