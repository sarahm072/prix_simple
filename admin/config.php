<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'simple_price';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>
