<?php
include('database.php');

$priceTotal = 0;
$names = array();
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
                document.getElementById('cart').innerHTML = <?php echo sizeof($_SESSION['cart']); ?>;

            <?php
                if(isset($_POST['reset'])) {
                    $_SESSION['cart'] = array();

                    //Return to the same page and exit()
                    header('location: '.$_SERVER[REQUEST_URI].'');
                    exit();
                }
                ?>
            }

            function removeFromCart(id) {
                setCookie("RemoveProduct", id, time() + (86400 / 24), "/"); //1 Hour Cookie

                if(in_array(id, <?php $_SESSION['cart'] ?>)) {
                    <?php
                        unset($_SESSION['cart'][$_COOKIE["RemoveProduct"]]);
                    ?>
                }
            }
        </script>
    </head>

    <body>
        <?php banner2(); ?>

        <br>

        <div style="display:flex; flex-wrap:nowrap;">
            <!--<h2>Shopping Cart</h2>
            <!--<h2 style="position:absolute; left:72.5%">Cart Summary</h2>
            <!-- Fix the position-->
        </div>

        <div style="display:flex; flex-wrap:nowrap; justify-content:space-between;">
            <div style="width:70%; background-color:rgba(255, 255, 255, 0.7);">
                <h2 style="color:black; align-self:flex-start;">Shopping Cart</h2>
                <div style="display:flex; justify-content:flex-end;">
                    <form action="" method="post" onsubmit="resetCart()">
                        <input type="submit" name="reset" value="Reset shopping cart">
                    </form>
                </div>

                <?php
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
                        echo '<div style="display:flex; flex-wrap:nowrap; align-items:center; justify-content:space-between;">';
                        product($row['productID'], $row['name'], $row['description'], $row['price']);
                        echo '<a id="nohover" style="color:black;">'.$row['name'].'</a>';
                        echo '<a id="nohover" style="color:black;">'.$row['price'].' kr.</a>';
                        ?>
                        <!-- Lav en form, med post, som refererer til en javascript funktion, som går videre til en php funktion-->
                        <input onclick="removeFromCart(<?php echo $row['id']; ?>)" type="image" src="../Icons/Trashcan.svg" style="align-self:flex-end; width:4%;">
                        <?php
                        echo '</div>';

                        //Horizontal line to space items
                        echo '<hr>';

                        $priceTotal += $row['price'];
                        $names[] = $row['name'];
                    }
                }
                ?>
            </div>

            <div style="display:flex; flex-direction:column; align-items:center; align-content:space-between; justify-content:flex-start; height:5%; width:25%; background-color:rgba(255, 255, 255, 0.7);">
                <?php
                echo '<h2 style="color:black; align-self:flex-start;">Cart Summary</h2>';

                foreach($names as $name) {
                    echo '<a id="nohover" style="color:black; align-self:flex-start;">1 x '.$name.'</a>';
                }
                ?>

                <!-- Temporary Linebreak -->
                <div style="height:10px;"></div>

                <a id="nohover" style="color:black;">Order Total: <?php echo $priceTotal; ?> kr.</a>
                <button>Proceed to checkout</button>
            </div>
        </div>
    </body>
</html>