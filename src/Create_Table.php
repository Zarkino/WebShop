<?php
//Users
$sql = "CREATE TABLE webshop.users (
userID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstName VARCHAR(50) NOT NULL,
lastName VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
userName VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
balance float(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}

//Products
$sql = "CREATE TABLE webshop.products (
produktID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
produktName VARCHAR(50) NOT NULL,
prdouktCatagory VARCHAR(50) NOT NULL,
produktPrice FLOAT(50) NOT NULL,
stock FLOAT(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}

//Transactions
$sql = "CREATE TABLE webshop.transactions
transactionID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FOREIGN KEY(userID) REFERENCES webuser(userID),
FOREIGN KEY(productID) REFERENCES product(produktID),
transcationTime dateTime NOT NULL,
totalprice FLOAT(50) NOT NULL
)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}

//Adress
$sql = "CREATE TABLE webshop.adress (
name INT(50) NOT NULL,
deliveringAdress INT(50) NOT NULL,
postalCode FLOAT(4) NOT NULL,
city INT(50) NOT NULL)

CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}

//Warrenty
$sql = "CREATE TABLE webshop.warranty
warrentyID INT(50) UNSIGNED,
FOREIGN KEY(transactionID) REFERENCES transactoion(transactionID),
ProductList INT(50) NOT NULL,
timeExpire dateTime)

CHARACTER SET latin1 COLLATE latin1_danish_ci";
if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}
?>

