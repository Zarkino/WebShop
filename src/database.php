<?php
require_once('connect.php');

function banner() {
	echo '<div style="width:100%; display:flex; justify-content: space-between;">';
        echo '<input class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = \'home.php\';" value="Home">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = \'login.php\';" value="Login">';
	echo '</div>';
}

function banner2() {
    if(isset($_POST['item'])) {
        search($_POST['item']);
    }

    echo '<ul class="bar">';
        echo '<li><form action="" method="POST"><input type="text" placeholder="Search" name="item" required><input type="image" src="../Icons/Search.svg" alt="Go" style="filter:invert(1); vertical-align: middle; padding-left:5px" height="22px" width="22px"></form></li>';
        echo '<li><a href=""></a></li>';
        echo '<li><a href="home.php">Home</a></li>';
        echo '<li><a href=""></a></li>';

        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE) {
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
    $sql = "SELECT * FROM webshop.brugere WHERE Username = ?";

    $stmt = $GLOBALS['conn']->prepare($sql);

    $stmt->bind_param('s', $username);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()) {
        if(password_verify($password, $row['Password'])) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["brugerID"] = $row['BrugerID'];
            $_SESSION["username"] = $row['Username'];
            $_SESSION["formue"] = $row['Formue'];

            header("location: home.php");
        } else {
            //Debug
            echo 'You entered: ' . $username . ' & ' . $password . '<br>';
            //echo "You have entered an incorrect username or password";
        }
    }
}

function listProducts() {
    /* To get specific Items from Table 'Products'
    if($column !== null && $item !== null) {
        $sql = "SELECT * FROM webshop.produkter WHERE $column = $item";
    }
    */

    $sql = "SELECT * FROM webshop.produkter";


    $result = $GLOBALS['conn']->query($sql);

    echo '<div style="display: flex; justify-content: space-between;">';

    $i = 0;
    while($row = $result->fetch_assoc()) {
        product($row['ProduktID'], $row['Produktnavn'], $row['Produktpris']);
        $i++;
        if($i === 4) {
            $i = 0;
            echo '</div>';
            echo '<div style="display: flex; justify-content: space-between;">';
        }
    }

    echo '</div>';
}

function product($id, $name, $price) {
	echo '<div class="container" onclick="location.href=\'productpage.php?id='.$id.'\';">';
        echo '<img class="image" style="width:250px; height:250px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">';

	    echo '<div class="overlay" style="text-align:center">';
	        echo '<a id="nohover" style="font-size:200%">'.$name.'</a><br>';
	        echo '<a id="nohover">'.$price.' kr.</a>';
	    echo '</div>';
	echo '</div>';
}

function search($item) {
    $sql = "SELECT * FROM webshop.produkter WHERE
    (`Produktnavn` LIKE '%".$item."%') OR
    (`Produktkategori` LIKE '%".$item."%') OR
    (`Produktpris` LIKE '%".$item."%')";

    $result = $GLOBALS['conn']->query($sql);

    while($row = $result->fetch_assoc()) {
        product($row['ProduktID'], $row['Produktnavn'], $row['Produktpris']);
    }
}
?>