<?php
//Personer
$sql = "CREATE TABLE lectioscraping.person (
personID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
skoleID VARCHAR(50) NOT NULL,
fornavn VARCHAR(50) NOT NULL,
efternavn VARCHAR(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$conn->query($sql)) {
    echo "Error creating table: " . $conn->error;
}

//Fag
$sql = "CREATE TABLE lectioscraping.fag (
fagID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
fagNavn VARCHAR(50) NOT NULL,
fagLink VARCHAR(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$conn->query($sql)) {
    echo "Error creating table: " . $conn->error;
}

//Hold
$sql = "CREATE TABLE lectioscraping.hold (
holdID INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
holdNavn VARCHAR(50) NOT NULL,
holdLink VARCHAR(50) NOT NULL)
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$conn->query($sql)) {
    echo "Error creating table: " . $conn->error;
}

//Relation Fag og Hold
$sql = "CREATE TABLE lectioscraping.faghold (
fagID INT(50) UNSIGNED,
holdID INT(50) UNSIGNED,
FOREIGN KEY (fagID) REFERENCES fag(fagID),
FOREIGN KEY (holdID) REFERENCES hold(holdID),
CONSTRAINT fag_hold UNIQUE (fagID,holdID))
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$conn->query($sql)) {
    echo "Error creating table: " . $conn->error;
}

//Relation Hold og Person
$sql = "CREATE TABLE lectioscraping.holdperson (
holdID INT(50) UNSIGNED,
personID INT(50) UNSIGNED,
FOREIGN KEY (holdID) REFERENCES hold(holdID),
FOREIGN KEY (personID) REFERENCES person(personID),
CONSTRAINT hold_person UNIQUE (holdID,PersonID))
CHARACTER SET latin1 COLLATE latin1_danish_ci";

if (!$conn->query($sql)) {
    echo "Error creating table: " . $conn->error;
}
?>
