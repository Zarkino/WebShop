<?php
require_once('database.php');

$sql = "CREATE DATABASE webshop";

if (connect()->query($sql)) {
    echo "Error creating database webshop: " . $conn->error;
}

$sql = "ALTER DATABASE webshop COLLATE latin1_danish_ci";

if (!connect()->query($sql)) {
    echo "Error creating database: webshop: " . $conn->error;
}

include('Create_Table.php');
header("location: home.php");

connect()->close();
?>