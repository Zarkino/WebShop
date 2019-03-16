<?php
include('database.php');

if(isset($_GET['id'])) {
    $sql = "SELECT * FROM webshop.products WHERE productID =".$_GET['id'];

    $result = connect()->query($sql);

    while ($row = $result->fetch_assoc()) {
        $id = $row['productID'];
        $name = $row['name'];
        $category = $row['category'];
        $description = $row['description'];
        $price = $row['price'];
        $stock = $row['stock'];
    }
} else {
    header('location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <LINK rel="stylesheet" type="text/css" href="../Styles/Style.css">
        <META charset="utf-8">
        <TITLE>Webshop</TITLE>
        <!--<LINK rel="icon" type="image/gif" href="../Icons/dollar.png"/>-->

        <script>
            function addToCart() {
                document.getElementById('cart').innerHTML = <?php echo sizeof($_SESSION['cart']); ?>;

                <?php
                if(isset($_POST['add'])) {
                    $_SESSION['cart'][] = $id;

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

        <a href="home.php">Home</a><a id="nohover">-></a><a href="home.php?category=<?php echo $category ?>"><?php echo $category ?></a>

        <br><br>

        <div style="width:30%; background-color:rgba(255, 255, 255, 0.7)">
            <img class="image" style="width:100%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">

            <h2 style="color:black"><?php echo $name; ?></h2>

            <a style="color:black">
                <?php echo $description; ?>
            </a>

            <br><br>

            <a style="color:black"><?php echo 'Price: ' . $price . ' kr.' . "<br>";
                echo 'Stock: ' . $stock . ' stk.' . "<br>";
                echo 'Category: ' . $category . "<br>" ?></a>
        </div>

        <br>

        <form action="" method="post" onsubmit="addToCart()">
            <input type="submit" name="add" value="Add to cart">
        </form>
    </body>
</html>
