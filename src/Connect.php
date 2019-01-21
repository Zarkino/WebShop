 <?php
$servername = "localhost";
$username = "root";
$password = "yes1";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

if(!$conn->select_db("webshop")) {
    print('Error connecting');
}
?>