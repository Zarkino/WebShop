<?php
include ('connect.php');
include "database.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    login($conn, $_POST['username'], $_POST['password']);
}
?>

<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<LINK rel="stylesheet" type="text/css" href="../Styles/Style.css">
		<META charset="utf-8">
		<TITLE>Webshop</TITLE>
		<LINK rel="icon" type="image/gif" href="Icon/dollar.png"/>
		
		<SCRIPT>
		</SCRIPT>
	</HEAD>
	
	<BODY>
		<?php
		buttonHeader();
		?>
		
		<H1>Webshop</H1>
		
            <H2>Login</H2>    
            <form method="POST">
                <INPUT type="text" placeholder="Username" name="username" required><br>
                <INPUT type="password" placeholder="Password" name="password" required><br>
                <BUTTON type="submit" class="buttonHead" name="submit" >Login</BUTTON>
            </form>
	</BODY>
</HTML>