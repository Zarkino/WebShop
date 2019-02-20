<?php
//require_once('connect.php');

function connect() {
    static $conn;

    if($conn === NULL) {
        $conn = new MySQLi('localhost', 'root', 'yes1');
        $conn->set_charset("utf8");
    }
    return $conn;
}

function banner() {
	echo '<div style="width:100%; display:flex; justify-content: space-around;">';
        echo '<input class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = \'home.php\';" value="Home">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = \'login.php\';" value="Login">';
    echo '</div>';
}

function banner2() {
    echo '<ul class="bar" style="margin: 0 -50px 0 -50px; width:calc(100% + 100px)">';
        echo '<li><input type="image" src="../Icons/Globe.svg" alt="Home" style="filter:invert(1); padding-right:5px;" height="35px"><a href="home.php" style="font-size:300%;">Webshop</a></li>';
        echo '<li><form action="home.php" method="POST"><input type="text" placeholder="Search" name="item" required><input type="image" src="../Icons/Search.svg" alt="Go" style="filter:invert(1); vertical-align: middle; padding: 3px 0 0 5px;" height="22px" width="22px"></form></li>';

        if(!isset($_SESSION['cart']) /* && sizeof($_SESSION['cart']) > 0*/) {
            echo '<li><a href="cart.php">1</a><input type="image" src="../Icons/Cart.svg" alt="Cart" style="filter:invert(1); vertical-align: middle; padding: 3px 0 0 5px;" height="35px" onclick="window.location = \'cart.php\';"></li>';
        } else {
            echo '<li><a href=""></a></li>';
        }

        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
            echo '<li><a href="logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="login.php">Login</a></li>';
        }
    echo '</ul>';
}

function footer() {
    echo '<div style="width:100%">';
    echo '</div>';
}

function login($username, $password) {
    $sql = "SELECT * FROM webshop.users WHERE username = ?";

    $stmt = connect()->prepare($sql);

    $stmt->bind_param('s', $username);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()) {
        if(password_verify($password, $row['password'])) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["userID"] = $row['userID'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["balance"] = $row['balance'];

            header("location: home.php");
        } else {
            echo 'You entered: ' . $username . ' & ' . $password . '<br>';
            //echo "You have entered an incorrect username or password";
        }
    }
}

function getProducts() {
    $sql = "SELECT * FROM webshop.products";
    $result = connect()->query($sql);

    return $result;
}

function listProducts($result) {
    /* To get specific Items from Table 'Products'
    if($column !== null && $item !== null) {
        $sql = "SELECT * FROM webshop.produkter WHERE $column = $item";
    }
    */

    echo '<div style="display: flex; justify-content: flex-start;">';

    $i = 0;
    while($row = $result->fetch_assoc()) {
        product($row['productID'], $row['name'], $row['description'], $row['price']);
        $i++;
        if($i === 5) {
            $i = 0;
            echo '</div>';
            echo '<div style="display: flex; justify-content: flex-start;">';
        }
    }

    echo '</div>';
}

function product($id, $name, $description, $price) {
	echo '<div class="container" style="position:relative; flex-basis:20%;" onclick="location.href=\'productpage.php?id='.$id.'\';">';
        echo '<img class="image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">';

	    echo '<div class="overlay" style="text-align:center">';
	        echo '<a id="nohover" style="font-size:200%">'.$name.'</a>';
	        echo '<br><br>';
	        echo '<a id="nohover">'.$description.'</a>';
	        echo '<br><br>';
	        echo '<a id="nohover">'.$price.' kr.</a>';
	    echo '</div>';
	echo '</div>';
}

function search($item) {
    $sql = "SELECT * FROM webshop.products WHERE
    (`name` LIKE '%".$item."%') OR
    (`category` LIKE '%".$item."%') OR
    (`price` LIKE '%".$item."%')";

    $result = connect()->query($sql);

    listProducts($result);
}
?>