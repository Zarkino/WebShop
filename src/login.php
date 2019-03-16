<?php
include('database.php');
?>

<!DOCTYPE HTML>
<HTML lang="en">
	<HEAD>
		<LINK rel="stylesheet" type="text/css" href="../Styles/Style.css">
		<META charset="utf-8">
		<TITLE>Webshop</TITLE>
		<!--<LINK rel="icon" type="image/gif" href="../Icon/dollar.png"/>-->
		
		<SCRIPT>
		</SCRIPT>
	</HEAD>
	
	<BODY>
		<?php banner2(); ?>

        <br>

        <H2>Login</H2>

        <form method="POST">
            <INPUT type="text" placeholder="Username" name="username" required><br>
            <INPUT type="password" placeholder="Password" name="password" required><br>
            <BUTTON type="submit" name="submit" >Login</BUTTON>
        </form>

        <a id="nohover">Don't have an account yet?</a> <a href="signup.php">Register here!</a>

        <?php
        echo '<br>';
        if(isset($_POST['username']) && isset($_POST['password'])) {
            login($_POST['username'], $_POST['password']);
        }
        ?>
	</BODY>
</HTML>