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
            <h2 style="color:black;">Your Information</h2>

            <a style="color:black">Account</a><br>
            <form action="new_user.php" method="POST">
                <input type="text" name="firstname" placeholder="Firstname" required>
                <input type="text" name="lastname" placeholder="Lastname" required><br>
                <input type="email" name="email" placeholder="Email" required>
                <!--<input type="tel" name="phone" placeholder="Phone"> --><!-- Not used, but could be useful -->
                <input type="hidden" name="url" value="checkout.php"><br>
                <button type="submit" name="submit">Confirm and pay</button>
            </form>

            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                buy($_SESSION['userID'], $_SESSION['cart']);
                header('location: account.php');
            }
            ?>
        </div>

        <br>
    </body>
</html>