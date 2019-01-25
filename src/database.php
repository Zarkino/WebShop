<?php
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

function login($conn, $username, $password) {
    $sql = "SELECT * FROM webshop.brugere WHERE username = ?";

    $stmt = $conn->prepare($sql);

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
	<DIV class="container">
        <IMG class="image" style="width:250px; height:250px" alt="Product" src="data:image/png;base64,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">

	    <DIV class="overlay">
	        <a style="font-size:200%"><?php echo $name ?></a><br>
	        <a><?php echo $info ?></a>
	    </DIV>
	</DIV>
	<?php
}

?>