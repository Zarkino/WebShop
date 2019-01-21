<?php
include ('Connect.php');

$sql = "CREATE DATABASE lectioscraping";

if (!$conn->query($sql)) {
    echo "Error creating database: " . $conn->error;
}

$sql = "ALTER DATABASE lectioscraping
COLLATE latin1_danish_ci";

if (!$conn->query($sql)) {
    echo "Error creating database: " . $conn->error;
}

include('Create_Table.php');
header("location: Lectio-Scraping.php");

$conn->close();
?>