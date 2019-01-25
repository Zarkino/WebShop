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
        
        <h1>Webshop</h1>
        
        <h2>Logget ind som: <?php echo htmlspecialchars($_SESSION["username"]);?></h2>

        <div style="display: flex; justify-content: space-between;">
            <?php product("Product1", "Information about the product:") ?>
            <?php product("Product2", "Information about the product:") ?>
            <?php product("Product3", "Information about the product:") ?>
            <?php product("Product4", "Information about the product:") ?>
        </div>

        <p>
            <a href="logout.php">Logout</a>
        </p>
    </body>
</html>