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
        <form action="changepassword.php" method="POST">
            <INPUT type="password" placeholder="Current Password" name="oldpassword"><br>
            <INPUT type="password" placeholder="New Password" name="newpassword" ><br>
            <INPUT type="password" placeholder="New Password" name="test" ><br>
              <BUTTON type="submit" name="submit" >Change password</BUTTON>
        </form>

        <a id="nohover">Already have an account?</a> <a href="login.php">Log in here!</a>
	</BODY>
</HTML>
