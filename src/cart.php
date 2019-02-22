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

        <script>
            function resetCart() {
                <?php
                if(isset($_POST['reset']))
                    $_SESSION['cart'] = array();
                ?>

                document.getElementById('cart').innerHTML = <?php echo sizeof($_SESSION['cart']); ?>;
            }
        </script>
    </head>

    <body>
        <?php banner2(); ?>

        <br>

        <h2>Shopping Cart</h2>

        <br>

        <div>
            <form action="" method="post" onsubmit="resetCart()">
                <input type="submit" name="reset" value="Reset shopping cart">
            </form>
        </div>

        <div style="display:flex; justify-content:space-between; background-color:rgba(255, 255, 255, 0.7);">
            <div style="width:25%;">
                <?php
                $priceTotal = 0;
                foreach($_SESSION['cart'] as $id) {
                    $sql = "SELECT * FROM webshop.products WHERE productID =$id";

                    $result = connect()->query($sql);

                    while($row = $result->fetch_assoc()) {
                        /*
                        echo '<div class="container" style="width:100%; justify-content:space-between;" onclick="location.href=\'productpage.php?id='.$id.'\';">';
                        echo '<img class="image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png" width="15%">';
                        echo '<h2>'.$row['name'].'</h2><a>'.$row['price'].' kr.</a>';
                        echo '</div>';
                        */
                        product($row['productID'], $row['name'], $row['description'], $row['price']);
                        $priceTotal += $row['price'];
                    }
                }
                ?>

                <!--<?php product(1, "Name", "Description", "40"); ?>-->
                <!--<?php product(2, "Name", "Description", "80"); ?>-->
                <!--Function to list all products in shopping cart-->
                <!--Sum all the items in the list-->
            </div>

            <br>

            <div style="display:flex; flex-direction:column; align-items:center; align-content:space-between; justify-content:flex-start; width:30%;">
                <a id="nohover" style="color:black;"><?php echo $priceTotal; ?> kr.</a>
                <button>Proceed to checkout</button>
            </div>
        </div>
    </body>
</html>