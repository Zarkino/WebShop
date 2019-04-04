<?php
require_once('database.php');

//Users
$sql = "CREATE TABLE IF NOT EXISTS webshop.users (
userID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
username VARCHAR(50) NOT NULL,
password CHAR(60) NOT NULL,
balance FLOAT(50,2) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

createTable($sql);

//Products
$sql = "CREATE TABLE IF NOT EXISTS webshop.products (
productID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
image VARCHAR(255),
category VARCHAR(50) NOT NULL,
description VARCHAR(50) NOT NULL,
price FLOAT(50,2) NOT NULL,
stock int(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

createTable($sql);

//Transactions
$sql = "CREATE TABLE IF NOT EXISTS webshop.transactions (
transactionID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
orderID INT(50) NOT NULL,
productID INT(50) UNSIGNED,
userID INT(50) UNSIGNED,
FOREIGN KEY(productID) REFERENCES products(productID),
FOREIGN KEY(userID) REFERENCES users(userID),
time TIMESTAMP DEFAULT CURRENT_TIMESTAMP())
CHARACTER SET latin1 COLLATE latin1_danish_ci";

createTable($sql);

//Reviews
$sql = "CREATE TABLE IF NOT EXISTS webshop.reviews (
reviewID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
review TEXT NOT NULL,
date DATETIME DEFAULT CURRENT_TIMESTAMP(),
productID INT(50) UNSIGNED,
userID INT(50) UNSIGNED,
FOREIGN KEY(productID) REFERENCES products(productID),
FOREIGN KEY(userID) REFERENCES users(userID))
CHARACTER SET latin1 COLLATE latin1_danish_ci";

createTable($sql);

function createTable($sql) {
    if (!connect()->query($sql)) {
        echo "Error creating table: " . connect()->error . "<br>";
    }
}
?>