<?php
include('database.php');

session_start();

//Skal bruges, når der skal søges efter kategori
if(!empty($_GET['column'])) $column = $_GET['column'];
if(!empty($_GET['item']))   $item = $_GET['item'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<LINK rel="stylesheet" type="text/css" href="../Styles/Style.css">
		<META charset="utf-8">
		<TITLE>Webshop</TITLE>
		<!--<LINK rel="icon" type="image/gif" href="../Icons/dollar.png"/>-->
    </head>

    <body>
        <?php banner2(); ?>

        <h1>Webshop</h1>

        <?php listProducts(getProducts()); ?>
    </body>
</html>