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

        <H2>Change password</H2>
        <form action="change_password.php" method="POST">
            <INPUT type="password" placeholder="Current Password" name="password"><br>
            <INPUT type="password" placeholder="New Password" name="newpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><br>
            <INPUT type="password" placeholder="New Password" name="checkpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><br>
            <BUTTON type="submit" name="submit" >Change your password</BUTTON>
        </form>

        <a id="nohover">Already have an account?</a> <a href="login.php">Log in here!</a>
	</BODY>
</HTML>
