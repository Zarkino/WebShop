<?php
function buttonHeader() {
	?>
	<DIV style="width:100%; margin:auto;">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = '';" value="">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = '';" value="">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = '';" value="">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = '';" value="">
		<INPUT class="button" style="width:19%" type="button" onclick="window.location = '';" value="">
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
?>