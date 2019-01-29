<?php
include ('connect.php');

$sql = "CREATE DATABASE webshop";

if ($GLOBALS['conn']->query($sql)) {
    echo "Error creating database webshop: " . $conn->error;
}

$sql = "ALTER DATABASE webshop
COLLATE latin1_danish_ci";

if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating database: webshop: " . $conn->error;
}

include('Create_Table.php');
header("location: home.php");

$conn->close();
?>