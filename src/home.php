<?php
include('database.php');

session_start();

//Skal bruges, når der skal søges efter kategori
if(!empty($_GET)) {
    //$sql = "SELECT * FROM webshop.produkter WHERE Produktkategori =" . $_GET["category"];
}

/*
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
    header("location: signup.php");
    exit;
}
 */
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<LINK rel="stylesheet" type="text/css" href="../Styles/Style.css">
		<META charset="utf-8">
		<TITLE>Webshop</TITLE>
		<!--<LINK rel="icon" type="image/gif" href="../Icons/dollar.png"/> -->
    </head>

    <body>
        <?php buttonHeader(); ?>
        
        <h1>Webshop</h1>

        <?php listProducts(); ?>

        <p>
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE) {
                echo '<a href="logout.php">Logout</a>';
            } ?>
        </p>
    </body>
</html>