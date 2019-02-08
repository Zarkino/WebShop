<?php
//Brugere
$sql = "CREATE TABLE webshop.brugere (
brugerID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
Email VARCHAR(50) NOT NULL,
Username VARCHAR(50) NOT NULL,
Password VARCHAR(50) NOT NULL,
Formue INT(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}

//Produkts
$sql = "CREATE TABLE webshop.produkter (
ProduktID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Produktnavn VARCHAR(50) NOT NULL,
Produktkategori VARCHAR(50) NOT NULL,
Produktpris FLOAT(50) NOT NULL,
Stock FLOAT(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}

//Transactions
$sql = "CREATE TABLE webshop.transactioner (
TransactionID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FOREIGN KEY(BrugerID) REFERENCES webbruger(BrugerID),
FOREIGN KEY(PRODUKTID) REFERENCES produkt(ProduktID),
TranscationTime dateTime NOT NULL,
Totalprice FLOAT(50) NOT NULL
)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}

//Adresse
$sql = "CREATE TABLE webshop.adresser (
Name INT(50) NOT NULL,
DeliveringAdress INT(50) NOT NULL,
Postnumber FLOAT(4) NOT NULL,
City INT(50) NOT NULL)

CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}

//Garanti
$sql = "CREATE TABLE webshop.garanti (
GarantiID INT(50) UNSIGNED,
FOREIGN KEY(TransactionID) REFERENCES transactoion(TransactionID),
ProductList INT(50) NOT NULL,
Timeexpire dateTime)

CHARACTER SET latin1 COLLATE latin1_danish_ci";
if (!$GLOBALS['conn']->query($sql)) {
    echo "Error creating table: " . $conn->error . "<br>";
}
?>

