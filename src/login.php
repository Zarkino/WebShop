<?php
include('database.php');
?>

<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<LINK rel="stylesheet" type="text/css" href="../Styles/Style.css">
		<META charset="utf-8">
		<TITLE>Webshop</TITLE>
		<!--<LINK rel="icon" type="image/gif" href="../Icon/dollar.png"/>-->
		
		<SCRIPT>
		</SCRIPT>
	</HEAD>
	
	<BODY>
		<?php
		banner2();
		?>
		
		<H1>Webshop</H1>
		
        <H2>Login</H2>

        <form method="POST">
            <INPUT type="text" placeholder="Username" name="username" required><br>
            <INPUT type="password" placeholder="Password" name="password" required><br>
            <BUTTON type="submit" class="buttonHead" name="submit" >Login</BUTTON>
        </form>

        <a id="nohover">Har du ikke en bruger?</a> <a href="signup.php">Lav en her!</a>

        <?php
        echo '<br>';
        if(isset($_POST['username']) && isset($_POST['password'])) {
            login($_POST['username'], $_POST['password']);
        }
        ?>
	</BODY>
</HTML>