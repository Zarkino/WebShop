<?php
include('database.php');

$sql = "SELECT * FROM webshop.produkter WHERE ProduktID =".$_GET["id"];

$result = $GLOBALS['conn']->query($sql);

while($row = $result->fetch_assoc()) {
    $name = $row['Produktnavn'];
    $category = $row['Produktkategori'];
    $price = $row['Produktpris'];
    $stock = $row['Stock'];
}
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

        <a href="home.php">Home</a>-><a href="home.php?category=<?php echo $category ?>"><?php echo $category ?></a>

        <br><br>

        <div style="width:25%; background-color:white">
            <img class="image" style="width:100%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">
        </div>

        <br>

        <div style="width:25%; background-color:white">
            <h2 style="color:black"><?php echo $name; ?></h2>

            <a id="nohover" style="color:black">
                <?php echo 'Description'; ?>
            </a>
        </div>

        <br>

        <div style="width:25%; background-color:white">
            <a id="nohover" style="color:black"><?php echo 'Price: ' . $price . ' kr.' . "<br>";
                echo 'Stock: ' . $stock . ' stk.' . "<br>";
                echo 'Category: ' . $category . "<br>" ?></a>
        </div>

        <br>

        <a href="">Add To Cart</a>
    </body>
</html>
