<?php
include('database.php');
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

        <br>

        <?php
        if(isset($_POST['item']) && !empty($_POST['item'])) {
            echo '<h2>Search results for "'.$_POST['item'].'"</h2>';
            search($_POST['item']);
        } else if(!empty($_GET['category'])) {
            listProducts(getProducts($_GET['category']));
        } else {
            listProducts(getProducts(""));
        }
        ?>
    </body>
</html>