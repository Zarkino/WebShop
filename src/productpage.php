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

        <h1><?php echo $name; ?></h1>

        <a id="nohover"><?php echo 'Price: ' . $price . "<br>";
            echo 'Stock: ' . $stock . "<br>";
            echo 'Category: ' . $category . "<br>" ?></a>

        <br>

        <a href="buy.php">Køb</a>
    </body>
</html>
