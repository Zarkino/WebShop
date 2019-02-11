<?php
require_once('database.php');

//Users
$sql = "CREATE TABLE webshop.users (
userID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
username VARCHAR(50) NOT NULL,
password CHAR(60) NOT NULL,
balance INT(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

createTable($sql);

//Products
$sql = "CREATE TABLE webshop.products (
productID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
category VARCHAR(50) NOT NULL,
description VARCHAR(50) NOT NULL,
price FLOAT(50) NOT NULL,
stock FLOAT(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

createTable($sql);

//Transactions
$sql = "CREATE TABLE webshop.transactions (
transactionID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FOREIGN KEY(userID) REFERENCES users(userID),
FOREIGN KEY(productID) REFERENCES products(productID),
time dateTime NOT NULL,
price FLOAT(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

createTable($sql);

//Adresses
$sql = "CREATE TABLE webshop.addresses (
name INT(50) NOT NULL,
address INT(50) NOT NULL,
postcode FLOAT(4) NOT NULL,
city INT(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

createTable($sql);

//Warranty
$sql = "CREATE TABLE webshop.warranty (
warrantyID INT(50) UNSIGNED,
FOREIGN KEY(transactionID) REFERENCES transactions(transactionID),
productList INT(50) NOT NULL,
expiration dateTime)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

createTable($sql);

function createTable($sql) {
    if (!connect()->query($sql)) {
        echo "Error creating table: " . connect()->error . "<br>";
    }
}
?>

