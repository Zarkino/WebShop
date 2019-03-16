<?php
include('database.php');
?>

<!DOCTYPE HTML>
<HTML lang="en">
	<HEAD>
		<LINK rel="stylesheet" type="text/css" href="../Styles/Style.css">
		<META charset="utf-8">
		<TITLE>Webshop</TITLE>
		<!--<LINK rel="icon" type="image/gif" href="../Icons/dollar.png"/>-->

		<SCRIPT>
		</SCRIPT>
	</HEAD>

	<BODY>
		<?php banner2(); ?>

        <br>

        <H2>Sign Up</H2>
        <form action="new_user.php" method="POST">
            <INPUT type="text" placeholder="Firstname" name="firstname" required><br>
            <INPUT type="text" placeholder="Lastname" name="lastname" required><br>
            <INPUT type="text" placeholder="E-mail" name="email" required><br>
            <INPUT type="text" placeholder="Username" name="username" required><br>
            <INPUT type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><br>
            <INPUT type="number" min="0" step="0.01"  placeholder="Balance" name="balance" required><br>
            <BUTTON type="submit" name="submit" >Sign Up</BUTTON>
        </form>

        <a id="nohover">Already have an account?</a> <a href="login.php">Log in here!</a>
	</BODY>
</HTML>
