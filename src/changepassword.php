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
    </head>

    <body>
        <?php banner2(); ?>

        <br>

        <H2>Change password</H2>
        <form action="" method="POST">
            <INPUT type="password" placeholder="Current Password" name="oldpassword"><br><br>
            <INPUT type="password" placeholder="New Password" name="newpassword"><br>
            <INPUT type="password" placeholder="Confirm Password" name="repeatpassword"><br>
            <BUTTON type="submit" name="submit">Change password</BUTTON>
        </form>

        <?php
        if(isset($_POST['submit'])) {
            $oldpassword = connect()->real_escape_string($_POST['oldpassword']);
            $newpassword = connect()->real_escape_string($_POST['newpassword']);
            $repeatpassword = connect()->real_escape_string($_POST['repeatpassword']);

            $sql = "SELECT * FROM webshop.users WHERE userID=".$_SESSION['userID'];

            $result = connect()->query($sql);

            while($row = $result->fetch_assoc()) {
                if(password_verify($oldpassword, $row['password'])) {
                    if($newpassword == $repeatpassword) {
                        $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

                        $sql = "UPDATE webshop.users SET `password`= '$hashed_password' WHERE userID=".$row['userID'];

                        if(!connect()->query($sql)) {
                            echo '<p>You have entered some wrong information!</p>';
                        } else {
                            echo '<p>You have successfully changed your password!</p>';
                        }
                    }
                }
            }
        }
        ?>
    </body>
</html>

