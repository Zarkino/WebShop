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
    </script>
</head>

<body>
<?php banner(); ?>

<br>

<div style="background-color:rgba(255, 255, 255, 0.7);">
    <h2 style="color:black;">Checkout</h2>

    <form action="new_user.php" method="POST">
        <a style="color:black">Contact Information</a><br>
        <input type="text" name="firstname" placeholder="Firstname" required>
        <input type="text" name="lastname" placeholder="Lastname" required><br>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" name="phone" placeholder="Phone"><br>
        <input type="hidden" name="url" value="checkout.php">
        <button type="submit" name="submit">Buy</button>
    </form>

    <br>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
        buy($_SESSION['userID'], $_SESSION['cart']);
        header('location: account.php');
    }
    ?>
</div>

<br>
</body>
</html>