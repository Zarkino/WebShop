<?php
require_once('database.php');

$sql = "CREATE DATABASE IF NOT EXISTS webshop";

if (connect()->query($sql)) {
    echo 'Error creating database: ' . connect()->error;
}

$sql = "ALTER DATABASE webshop COLLATE latin1_danish_ci";

if (!connect()->query($sql)) {
    echo 'Error creating database: ' . connect()->error;
}

include('Create_Table.php');
header("location: home.php");

connect()->close();
?>