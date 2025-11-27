<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simple_price";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>
