 <?php
$servername = "localhost";
$username = "root";
$password = "yes1";

GLOBAL $conn;

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

if(!$conn->select_db("webshop")) {
    print('Error connecting' . $conn->connect_error);
}

class Database {
    private static $db;
    private $conn;

    private function create() {
        $this->conn = new MySQLi('localhost', 'root', 'yes1');
        self::$db->conn->set_charset("utf8");
    }

    private function destroy() {
        $this->conn->close();
    }

    public static function connection() {
        return self::$db->conn;
    }
}
?>