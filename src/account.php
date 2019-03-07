<?php
include('database.php');

if(!isset($_SESSION['loggedin'])) {
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
    </head>

    <body>
        <?php banner2(); ?>

        <br>

        <div style="background-color:rgba(255, 255, 255, 0.7);">
            <h2 style="color:black;">Your Account</h2>
            <?php
            $userID = $_SESSION['userID'];
            $sql = "SELECT * FROM webshop.users WHERE userID='$userID'";

            if($result = connect()->query($sql)) {
                while($row = $result->fetch_assoc()) {
                    echo '<a style="color:black;">Name: '.$row['firstname'].' '.$row['lastname'].'</a><br>';
                    echo '<a style="color:black;">Email: '.$row['email'].'</a><br>';
                    echo '<a style="color:black;">Username: '.$row['username'].'</a><br>';
                    echo '<a style="color:black;">Balance: '.$row['balance'].' kr.</a><br>';
                }
            }
            ?>
        </div>

        <br>

        <div style="background-color:rgba(255, 255, 255, 0.7);">
            <h2 style="color:black;">Transactions</h2>
            <table id="transactions">
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Date/Time</th>
                </tr>
                <?php
                //Code to list all transactions
                $sql = "SELECT * FROM webshop.products";

                $result = connect()->query($sql);

                $orderID = 0;
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                        echo '<td>'.$orderID.'</td>';
                        echo '<td>'.$row['name'].'</td>';
                        echo '<td>Good</td>';
                        echo '<td>'.$row['price'].' kr.</td>';
                        echo '<td>'.date('d-m/Y').'<br> '.date('H:i').'</td>';
                    echo '</tr>';
                    $orderID++;
                }
                ?>
            </table>
        </div>

        <br>
    </body>
</html>