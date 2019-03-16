<?php
//require_once('connect.php');

session_start();
if(!isset($_SESSION['cart']))
    $_SESSION['cart'] = array();

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
        echo '<li><form action="home.php" method="POST"><input type="text" placeholder="Search" name="item"><input type="image" src="../Icons/Search.svg" alt="Go" style="filter:invert(1); vertical-align: middle; padding: 3px 0 0 5px;" height="22px" width="22px"></form></li>';

        echo '<li><a id="cart" href="cart.php">'.sizeof($_SESSION['cart']).'</a><input type="image" src="../Icons/Cart.svg" alt="Cart" style="filter:invert(1); vertical-align: middle; padding: 3px 0 0 5px;" height="35px" onclick="window.location = \'cart.php\';"></li>';

        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
            echo '<li><a href="account.php">Your Account</a></li>';
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

function getProducts($category) {
    if(empty($category))
        $sql = "SELECT * FROM webshop.products";
    else
        $sql = "SELECT * FROM webshop.products WHERE category='$category'";

    $result = connect()->query($sql);

    return $result;
}

function listProducts($result) {
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

	    echo '<div class="overlay" style="display:flex; flex-direction:column; align-items:center; justify-content:space-evenly;">';
	        echo '<a id="nohover" style="font-size:200%;">'.$name.'</a>';
	        echo '<a id="nohover">'.$description.'</a>';
	        echo '<a id="nohover">'.$price.' kr.</a>';
	        echo '<form action="" method="post">';
	            echo '<input type="hidden" value="'.$id.'" name="id">';
	            echo '<input type="submit" value="Add to cart" name="buy">';
	        echo '</form>';
	    echo '</div>';
	echo '</div>';

	//Add the product to cart
	if(isset($_POST['buy'])) {
        $_SESSION['cart'][] = $_POST['id'];

        header('location: '.$_SERVER['REQUEST_URI'].'');
        exit();
    }
}

function search($item) {
    $sql = "SELECT * FROM webshop.products WHERE
    (`name` LIKE '%".$item."%') OR
    (`category` LIKE '%".$item."%') OR
    (`price` LIKE '%".$item."%')";

    $result = connect()->query($sql);

    listProducts($result);
}

function buy($userID, $products) {
    $sql = "SELECT MAX(orderID) AS MAKS FROM webshop.transactions";

    $result = connect()->query($sql);

    $order = ($result->fetch_assoc())['MAKS'] + 1;

    foreach($products as $productID) {
        $sql = "INSERT INTO webshop.transactions (orderID, productID, userID)
          VALUES ('$order', '$productID', '$userID')";

        if(!connect()->query($sql)) {
            echo connect()->error . "<br>";
        }
    }
    $_SESSION['cart'] = array();
}

function listOrder($lastOrderID, $products, $price, $time){
    echo '<tr>';
    echo '<td>'.$lastOrderID.'</td>';
    echo '<td>';
    for($i = 0; $i < sizeof($products); $i++) {
        echo '1x ' . $products[$i];

        if($i < sizeof($products)-1) {
            echo ', ';
        }
    }
    echo '</td>';
    echo '<td>Good</td>';
    echo '<td>'.$price.' kr.</td>';
    echo '<td>'.$time->format('d-m/Y H:i').'</td>';
    echo '</tr>';
}
?>