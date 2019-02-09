 <?php
$server = "localhost";
$username = "root";
$password = "yes1";

GLOBAL $conn;

$conn = new MySQLi($server, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

if(!$conn->select_db("webshop")) {
    print('Error connecting' . $conn->connect_error);
}

class Database {
    private $server = "localhost";
    private $username = "root";
    private $password = "yes1";

    private $conn;

    public function connect() {
        if(empty($this->conn)) {
            $this->conn = new MySQLi($this->server, $this->username, $this->password);

            if($this->conn->connect_error) {
                connect();
            }
        }

        return $this->conn;
    }
}
?>