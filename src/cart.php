<?php
include('database.php');

/* $_GET['id'] tager arrayet fra cart
if(isset($_GET['id']))
    $products = $_GET['id'];

foreach($products as $productID) {
    $sql = "SELECT name, description, price FROM webshop.products WHERE productID='%".$productID."%'";

    $result = connect()->query($sql);

    while($row = $result->fetch_assoc()) {
        product($row['productID'], $row['name'], $row['description'], $row['price']);
    }
}
*/
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

        <div>
            <form action="" method="post">
                <input type="submit" name="reset" value="Reset shopping cart">
            </form>

            <?php
            if(isset($_POST['reset']))
                $_SESSION['cart'] = array();
            ?>
        </div>

        <div style="display:flex; justify-content:space-between; background-color:rgba(255, 255, 255, 0.7);">
            <div style="width:30%;">
                <?php product(1, "Name", "Description", "40"); ?>
                <?php product(2, "Name", "Description", "80"); ?>
                <!--Function to list all products in shopping cart-->
                <!--Sum all the items in the list-->
            </div>

            <br>

            <div style="display:flex; flex-direction:column; align-items:center; align-content:space-between; justify-content:flex-end; width:30%;">
                <a id="nohover" style="color:black;">Total: 120 kr.</a>
                <button>Proceed to checkout</button>
            </div>
        </div>
    </body>
</html>
