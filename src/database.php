<?php
include('connect.php');

function buttonHeader() {
	echo '<div style="width:100%; margin:auto;">';
        echo '<input class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = \'home.php\';" value="Home">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<input class="button" style="width:19%" type="button" onclick="window.location = \'login.php\';" value="Login">';
	echo '</div>';
}

function login($username, $password) {
    $sql = "SELECT * FROM webshop.brugere WHERE username = ?";

    $stmt = $GLOBALS['conn']->prepare($sql);

    $stmt->bind_param('s', $username);

    $stmt->execute();

    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()) {
        if(password_verify($password, $row['Password'])) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["brugerID"] = $row['BrugerID'];
            $_SESSION["username"] = $username;
            $_SESSION["formue"] = $row['Formue'];

            header("location: home.php");
        } else {
            echo "Du har indtastet et forkert brugernavn eller password";
        }
    }
}

function listProducts() {
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

function product($id, $name, $info) {
	echo '<div class="container" onclick="location.href=\'productpage.php?id='.$id.'\';">';
        echo '<img class="image" style="width:250px; height:250px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">';

	    echo '<div class="overlay" style="text-align:center">';
	        echo '<a id="nohover" style="font-size:200%">'.$name.'</a><br>';
	        echo '<a id="nohover">'.$info.'</a>';
	    echo '</div>';
	echo '</div>';
}
?>