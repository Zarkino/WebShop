<?php
include ('Connect.php');

$sql = "CREATE DATABASE webshop";

if (!$conn->query($sql)) {
    echo "Error creating database: " . $conn->error;
}

$sql = "ALTER DATABASE webshop
COLLATE latin1_danish_ci";

if (!$conn->query($sql)) {
    echo "Error creating database: " . $conn->error;
}

include('Create_Table.php');
header("home.php");

$conn->close();
?>