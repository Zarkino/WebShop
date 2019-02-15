<?php
include('connect.php');

$sql = 'DROP DATABASE webshop';
if (!$conn->query($sql)) {
    echo 'Error dropping database: ' . $conn->error();
}

header("location: home.php");

$conn->close();
?>