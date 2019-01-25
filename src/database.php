<?php
include('connect.php');

function buttonHeader() {
	?>
	<DIV style="width:100%; margin:auto;">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = '';" value="">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = '';" value="">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = '';" value="">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = '';" value="">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = 'login.php';" value="Login">
	</DIV>
	<?php
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

function product($name, $info) {
    ?>
	<DIV class="container" onclick="location.href='<?php //Link to product-page ?>'">
        <IMG class="image" style="width:250px; height:250px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">

	    <DIV class="overlay">
	        <a style="font-size:200%"><?php echo $name ?></a><br>
	        <a><?php echo $info ?></a>
	    </DIV>
	</DIV>
	<?php
}
?>