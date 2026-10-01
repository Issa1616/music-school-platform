<?php 
$conn = new mysqli('127.0.0.1', 'root', '1234', 'proyecto');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>