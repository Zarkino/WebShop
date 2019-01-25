<?php
include('database.php');

session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<LINK rel="stylesheet" type="text/css" href="../Styles/Style.css">
		<META charset="utf-8">
		<TITLE>Webshop</TITLE>
		<LINK rel="icon" type="image/gif" href="Icon/dollar.png"/>
    </head>
    <body>
        <?php
        buttonHeader();
        ?>
        
        <H1>Webshop</H1>
        
        <H2>Logget ind som: <?php echo htmlspecialchars($_SESSION["username"]);?></H2>

        <?php product("Product", "Information about the product:") ?>

        <p>
            <a href="logout.php">Logout</a>
        </p>
    </body>
</html>