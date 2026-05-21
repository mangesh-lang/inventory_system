<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'enterprise_inventory_system';
$conn = mysqli_connect($host, $user, $pass, $dbname);
if(!$conn){ die('Database connection failed: '.mysqli_connect_error()); }
mysqli_set_charset($conn, 'utf8mb4');
$base_url = 'http://localhost/enterprise_inventory_system/';
?>
