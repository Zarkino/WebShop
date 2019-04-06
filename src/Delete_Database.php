<?php
include('database.php');

$sql = "DROP DATABASE webshop";

if (!connect()->query($sql)) {
    echo 'Error dropping database: ' . connect()->error();
}

header('location: home.php');

connect()->close();
?>