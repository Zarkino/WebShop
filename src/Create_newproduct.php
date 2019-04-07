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

		<SCRIPT>
		</SCRIPT>
	</HEAD>

	<BODY>
		<?php banner(); ?>

        <br>

        <H2>Sign Up</H2>
        <form action="new_product.php" method="POST">
            <INPUT type="text" placeholder="name" name="name" ><br>
            <INPUT type="text" placeholder="Image" name="image" ><br>
            <INPUT type="text" placeholder="Catagory" name="category" ><br>
            <INPUT type="number" placeholder="price" name="price"><br>
						<INPUT type="number" placeholder="stock" name="stock"><br>
						<textarea cols="50"  rows="4" placeholder= 'Write a product description here' name="description" ></textarea><br>
						 <!-- <textarea form="review_form" name="review" maxlength="250" rows="4" placeholder="Write Here!" style="color:black; width:calc(100% - 30px); resize:vertical;"></textarea> -->
            <!-- <input type="hidden" name="url" value="home.php"> -->
            <BUTTON type="submit" name="submit" >Create new product</BUTTON>
        </form>

	</BODY>
</HTML>
