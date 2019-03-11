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
                    <th>Products</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Date/Time</th>
                </tr>
                <?php
                //Code to list all transactions
                $userID = $_SESSION['userID'];
                $sql = "SELECT * FROM webshop.transactions WHERE userID='$userID'";

                $result = connect()->query($sql);

                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                        echo '<td>'.$row['orderID'].'</td>';
                        echo '<td>'.$row['productID'].'</td>';
                        echo '<td>Good</td>';
                        echo '<td>0 kr.</td>';
                        echo '<td>'.$row['time'].'</td>';
                    echo '</tr>';
                    //Format date('d-m/Y').'<br> '.date('H:i')
                }

                /*
                echo '<tr>';
                echo '<td>';
                echo '<td>';
                echo '<td>';
                echo '<td>';
                echo '<td>';

                $i = 0;
                while($row = $result->fetch_assoc()) {
                    if($row['orderID'] != $i) {
                        echo $row['orderID'];
                        echo $row['productID'];
                        echo 'Good';
                        echo '0 kr.';
                        echo $row['time'];
                        //Format date('d-m/Y').'<br> '.date('H:i')
                    } else {
                        echo '</td>';
                        echo '</td>';
                        echo '</td>';
                        echo '</td>';
                        echo '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>';
                        echo '<td>';
                        echo '<td>';
                        echo '<td>';
                        echo '<td>';
                        $i = $row['orderID'];
                        echo $row['orderID'];
                        echo $row['productID'];
                        echo 'Good';
                        echo '0 kr.';
                        echo $row['time'];
                        //Format date('d-m/Y').'<br> '.date('H:i')
                    }
                }
                */
                ?>
            </table>
        </div>

        <br>
    </body>
</html>