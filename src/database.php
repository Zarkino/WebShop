<?php
include('connect.php');

function buttonHeader() {
	echo '<DIV style="width:100%; margin:auto;">';
        echo '<INPUT class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<INPUT class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<INPUT class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<INPUT class="button" style="width:19%" type="button" onclick="window.location = ;" value="">';
		echo '<INPUT class="button" style="width:19%" type="button" onclick="window.location = \'login.php\';" value="Login">';
	echo '</DIV>';
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
        product($row['Produktnavn'], $row['Produktpris']);
        $i++;
        if($i === 4) {
            $i = 0;
            echo '</div>';
            echo '<div style="display: flex; justify-content: space-between;">';
        }
    }

    echo '</div>';
}

function product($name, $info) {
	echo '<div class="container" onclick="location.href=">';
        echo '<img class="image" style="width:250px; height:250px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">';

	    echo '<div class="overlay">';
	        echo '<a style="font-size:200%">'.$name.'</a><br>';
	        echo '<a>'.$info.'</a>';
	    echo '</div>';
	echo '</div>';
}
?>