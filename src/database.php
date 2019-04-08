<?php
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
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["balance"] = $row['balance'];

            header("location: home.php");
        } else {
            //echo 'You entered: ' . $username . ' & ' . $password . '<br>';
            echo '<p>'."You have entered an incorrect username or password".'</p>';
        }
    }
}

function generateRandomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, strlen($alphabet) - 1);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
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
        product($row['productID'], $row['name'], $row['image'], $row['description'], $row['price']);
        $i++;
        if($i === 5) {
            $i = 0;
            echo '</div>';
            echo '<div style="display: flex; justify-content: flex-start;">';
        }
    }

    echo '</div>';
}

function product($id, $name, $image, $description, $price) {
	echo '<div class="container" style="position:relative; flex-basis:20%;" onclick="location.href=\'productpage.php?id='.$id.'\';">';
	    if($image != null) {
            echo '<img class="image" src="'.$image.'">';
        } else {
            echo '<img class="image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">';
        }

	    echo '<div class="overlay" style="display:flex; flex-direction:column; align-items:center; justify-content:space-evenly;">';
	        echo '<a style="color:white; font-size:3vw;">'.$name.'</a>';
	        echo '<a style="color:white; font-size:2vw;">'.$description.'</a>';
	        echo '<a style="color:white; font-size:2vw;">'.$price.' kr.</a>';
	        echo '<form action="" method="post">';
	            echo '<input type="hidden" value="'.$id.'" name="id">';
	            echo '<input class="button" type="submit" value="Add to cart" name="buy">';
	        echo '</form>';
	    echo '</div>';
	echo '</div>';

	//Add the product to cart
	if(isset($_POST['buy'])) {
        $_SESSION['cart'][] = $_POST['id'];

        header('location: '.$_SERVER['REQUEST_URI']);
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
    $validStock = true;
    $totalPrice = 0;

    //Check if stock is above buying amount and calculate total price
    foreach($products as $productID) {
        $sql = "SELECT stock, price FROM webshop.products WHERE productID=".$productID;

        $result = connect()->query($sql);

        while($row = $result->fetch_assoc()) {
            $totalPrice += $row['price'];
            if($row['stock'] < array_count_values($products)[$productID]) {
                $validStock = false;
                break;
            }
        }
    }

    //Make the transactions if the stock is valid and balance is higher than the total price
    if($validStock && $totalPrice <= $_SESSION['balance']) {
        $sql = "SELECT MAX(orderID) AS MAKS FROM webshop.transactions";

        $result = connect()->query($sql);

        $order = ($result->fetch_assoc())['MAKS'] + 1;

        foreach ($products as $productID) {
            //Remove 1 of item from stock
            $sql = "UPDATE webshop.products
                    SET stock=stock-1
                    WHERE productID=".$productID;

            connect()->query($sql);

            //Make transaction
            $sql = "INSERT INTO webshop.transactions (orderID, productID, userID)
                    VALUES ('$order', '$productID', '$userID')";

            connect()->query($sql);
        }
        $_SESSION['cart'] = array();
    }
}

function listOrder($lastOrderID, $products, $price, $time) {
    $uniqueProducts = array_values(array_unique($products));
    echo '<tr>';
    echo '<td>'.$lastOrderID.'</td>';
    echo '<td>';
    for($i = 0; $i < sizeof($uniqueProducts); $i++) {
        //Count identical values in $products with $uniqueProducts[$i] as key
        echo  array_count_values($products)[$uniqueProducts[$i]] . 'x ' . $uniqueProducts[$i];

        if($i < sizeof($uniqueProducts) - 1) {
            echo ', ';
        }
    }
    echo '</td>';
    echo '<td>Good</td>';
    echo '<td>'.$price.' kr.</td>';
    echo '<td>'.$time->format('d-m/Y H:i').'</td>';
    echo '</tr>';
}

function sendMail($msg, $subject, $email) {
    //Use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    //Send email
    mail($email, $subject, $msg);
}
?>
