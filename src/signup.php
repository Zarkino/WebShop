<?php
include('database.php');
?>

<!DOCTYPE HTML>
<HTML>
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

		<H1>Webshop</H1>

            <H2>Opret Bruger</H2>
            <form action="new_user.php" method="POST">
                <INPUT type="text" placeholder="Fornavn" name="firstname" required><br>
				<INPUT type="text" placeholder="Efternavn" name="lastname" required><br>
				<INPUT type="text" placeholder="E-mail" name="email" required><br>
	            <INPUT type="text" placeholder="Username" name="username" required><br>
                <INPUT type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><br>
                <INPUT type="number" min="0" step="0.01"  placeholder="Formue" name="formue" required><br>
                <BUTTON type="submit" class="buttonHead" name="submit" >Opret Bruger</BUTTON>
            </form>

            <a id="nohover">Har du allerede en bruger?</a> <a href="login.php">Log ind her!</a>
	</BODY>
</HTML>
