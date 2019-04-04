<?php
include('database.php');
//test
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
        <?php banner(); ?>

        <br>

        <div style="background-color:rgba(255, 255, 255, 0.7);">
            <h2 style="color:black;">Your Account</h2>
            <?php
            $sql = "SELECT * FROM webshop.users WHERE userID=".$_SESSION['userID'];

            if($result = connect()->query($sql)) {
                while($row = $result->fetch_assoc()) {
                    echo '<a style="color:black;">Name: '.$row['firstname'].' '.$row['lastname'].'</a><br>';
                    echo '<a style="color:black;">Email: '.$row['email'].'</a><br>';
                    echo '<a style="color:black;">Username: '.$row['username'].'</a><br>';
                    echo '<a style="color:black;">Balance: '.$row['balance'].' kr.</a><br>';
                }
            }
            ?>
            <br>
            <a style="color:black;" href="changepassword.php">Change Password</a>
        </div>

        <br>

        <div style="background-color:rgba(255, 255, 255, 0.7);">
            <h2 style="color:black;">Transactions</h2>
            <table id="transactions">
                <tr>
                    <th>Order ID</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Date & Time</th>
                </tr>
                <?php
                $sql = "SELECT
	                      transactions.*, products.*
                        FROM
	                      webshop.transactions
                        INNER JOIN
	                      webshop.products
                        ON
	                      transactions.productID = products.productID
                        WHERE
	                      transactions.userID=".$_SESSION['userID']."
	                    ORDER BY transactionID";

                $result = connect()->query($sql);

                $lastOrderID = null;
                $products = array();
                $price = 0;

                while($row = $result->fetch_assoc()) {
                    if($lastOrderID === NULL) {
                        $lastOrderID = $row['orderID'];
                    }

                    if($row['orderID'] == $lastOrderID) {
                        $products[] = $row['name'];
                        $price += $row['price'];
                        $time = new DateTime($row['time']);
                    } else {
                        listOrder($lastOrderID, $products, $price, $time);

                        //Reset values after listing an order
                        $lastOrderID = $row['orderID'];
                        $products = array();
                        $products[] = $row['name'];
                        $price = $row['price'];
                    }
                }
                if(mysqli_num_rows($result) > 0)
                        listOrder($lastOrderID, $products, $price, $time);
                ?>
            </table>
        </div>

        <br>
    </body>
</html>
