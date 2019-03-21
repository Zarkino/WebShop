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
                    header('location: '.$_SERVER['REQUEST_URI'].'');
                    exit();
                }
                ?>
            }
        </script>
    </head>

    <body>
        <?php banner2(); ?>

        <br>

        <div style="display:flex; flex-wrap:nowrap; justify-content:space-between;">
            <div style="width:70%; background-color:rgba(255, 255, 255, 0.7);">
                <div style="display:flex; justify-content:space-between;">
                    <h2 style="color:black;">Shopping Cart</h2>
                    <form action="" method="post" onsubmit="resetCart()">
                        <input type="submit" name="reset" value="Reset shopping cart">
                    </form>
                </div>

                <?php
                foreach($_SESSION['cart'] as $id) {
                    $sql = "SELECT * FROM webshop.products WHERE productID =".$id;

                    $result = connect()->query($sql);

                    while($row = $result->fetch_assoc()) {
                        echo '<div style="display:flex; flex-wrap:nowrap; align-items:center; justify-content:space-between;" onclick="location.href=\'productpage.php?id='.$id.'\';">';
                        echo '<img style="width:100px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">';
                        echo '<a style="color:black;">'.$row['name'].'</a>';
                        echo '<a style="color:black;">'.$row['price'].' kr.</a>';

                        echo '<form action="" method="post">';
                            echo '<input type="image" src="../Icons/Trashcan.svg" style="align-self:flex-end; width:40px;">';
                            echo '<input type="hidden" name="removeItem" value="'.$row['productID'].'">';
                            echo '<input class="hidden" type="submit" value="">';
                        echo '</form>';
                        echo '</div>';

                        //Remove the item from cart if the trash-can is clicked
                        if(isset($_POST['removeItem'])) {
                            $key = array_search($_POST['removeItem'], $_SESSION['cart']);
                            unset($_SESSION['cart'][$key]);
                            $_SESSION['cart'] = array_values($_SESSION['cart']);

                            //Return to the same page and exit()
                            header('location: '. $_SERVER['REQUEST_URI'] .'');
                            exit();
                        }

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
                    echo '<a style="color:black; align-self:flex-start;">1 x '.$name.'</a>';
                }
                ?>

                <!-- Temporary Linebreak -->
                <div style="height:10px;"></div>

                <a style="color:black;">Order Total: <?php echo $priceTotal; ?> kr.</a>
                <form action="" method="post">
                    <input type="submit" name="buy" value="Proceed to checkout">
                </form>

                <?php
                if(isset($_POST['buy']) && sizeof($_SESSION['cart']) > 0) {
                    if(isset($_SESSION['loggedin'])) {
                        buy($_SESSION['userID'], $_SESSION['cart']);
                        header('location: ' . $_SERVER['REQUEST_URI'] . '');
                    } else {
                        header('location: checkout.php');
                    }
                }
                ?>

            </div>
        </div>

        <br>
    </body>
</html>