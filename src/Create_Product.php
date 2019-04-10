<?php
include('database.php');
?>

<!DOCTYPE HTML>
<HTML lang="en">
	<HEAD>
		<LINK rel="stylesheet" type="text/css" href="../Styles/Style.css">
		<META charset="utf-8">
		<TITLE>Webshop</TITLE>
		<!--<LINK rel="icon" type="image/gif" href="../Icons/dollar.png"/>-->
	</HEAD>

	<BODY>
		<?php banner(); ?>

        <br>

        <H2>New Product</H2>
        <form action="new_product.php" method="POST">
            <INPUT type="text" placeholder="Name" name="name" ><br>
            <INPUT type="text" placeholder="Image URL" name="image" ><br>
            <INPUT type="text" placeholder="Category" name="category" ><br>
            <INPUT type="number" placeholder="Price" name="price"><br>
            <INPUT type="number" placeholder="Stock" name="stock"><br>
            <textarea name="description" cols="50" rows="4" placeholder="Write a product description here!" style="color:black;"></textarea><br>
            <BUTTON type="submit" name="submit" >Create new product</BUTTON>
        </form>
	</BODY>
</HTML>
