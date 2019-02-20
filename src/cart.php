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

        <h2>Shopping Cart</h2>

        <br>

        <div style="display:flex; justify-content:space-between; background-color:rgba(255, 255, 255, 0.7);">
            <div style="width:30%;">
                <?php product(1, "Name", "Description", "40"); ?>
                <?php product(2, "Name", "Description", "80"); ?>
                <!--Function to list all products in shopping cart-->
                <!--Sum all the items in the list-->
            </div>
            <div>
                <a>40 kr.</a>
                <br>
                <a>80 kr.</a>
            </div>

            <br>

            <div style="display:flex; flex-direction:column-reverse; align-items:center; align-content:space-between; width:30%;">
                <button>Proceed to checkout</button>

                <a id="nohover" style="color:black;">Total: 120 kr.</a>
            </div>
        </div>
    </body>
</html>
