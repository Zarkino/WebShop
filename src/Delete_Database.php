<?php
include ('Connect.php');

$sql = 'DROP DATABASE lectioscraping';
if (!$conn->query($sql)) {
    echo 'Error dropping database: ' . $conn->error();
}

header("location: Lectio-Scraping.php");

$conn->close();
?>