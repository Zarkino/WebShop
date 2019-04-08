<?php
include('database.php');

if(isset($_GET['id'])) {
    $sql = "SELECT * FROM webshop.products WHERE productID =".$_GET['id'];

    $result = connect()->query($sql);

    while ($row = $result->fetch_assoc()) {
        $id = $row['productID'];
        $name = $row['name'];
        $image = $row['image'];
        $category = $row['category'];
        $description = $row['description'];
        $price = $row['price'];
        $stock = $row['stock'];
    }
} else {
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

        <script>
            function addToCart() {
                document.getElementById('cart').innerHTML = <?php echo sizeof($_SESSION['cart']); ?>;

                <?php
                if(isset($_POST['add'])) {
                    $_SESSION['cart'][] = $id;

                    //Return to the same page and exit()
                    header('location: '.$_SERVER['REQUEST_URI']);
                    exit();
                }
                ?>
            }
        </script>
    </head>

    <body>
        <?php banner(); ?>

        <br>

        <a href="home.php">Home</a><a id="nohover">-></a><a href="home.php?category=<?php echo $category ?>"><?php echo $category ?></a>

        <br><br>

        <div style="width:30%; background-color:rgba(255, 255, 255, 0.7)">
            <?php
            if($image != null) {
                echo '<img class="image" style="width:100%;" src="'.$image.'">';
            } else {
                echo '<img class="image" style="width:100%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Antu_draw-cuboid.svg/500px-Antu_draw-cuboid.svg.png">';
            }?>

            <h2 style="color:black"><?php echo $name; ?></h2>

            <a style="color:black">
                <?php echo $description; ?>
            </a>

            <br><br>

            <a style="color:black"><?php echo 'Price: ' . $price . ' kr.' . "<br>";
                echo 'Stock: ' . $stock . ' stk.' . "<br>";
                echo 'Category: ' . $category . "<br>" ?></a>
        </div>

        <br>

        <form action="" method="post" onsubmit="addToCart()">
            <input type="submit" name="add" value="Add to cart">
        </form>

        <br>

        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div style="width:calc(50% - 25px); background-color:rgba(255, 255, 255, 0.7)">
                <h2 style="color:black;">Costumer Reviews</h2>
                <?php
                $sql = "SELECT * FROM webshop.reviews WHERE productID=".$id;

                $result = connect()->query($sql);

                if(mysqli_num_rows($result) < 1) {
                    echo '<a style="font-size:100%; color:black;">Be the first to review this product!</a>';
                } else {
                    $sql = "SELECT reviews.review, reviews.date, users.username
                        FROM webshop.reviews
                        INNER JOIN webshop.users ON reviews.userID=users.userID
                        WHERE reviews.productID=" . $id;

                    $result = connect()->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $date = new DateTime($row['date']);

                        echo '<div style="display:flex; flex-direction:column; flex-wrap:nowrap;">';
                        echo '<a style="color:black;">By '.$row['username'].'</a><br>';
                        echo '<a style="font-size:100%; color:black;">'.$row['review'].'</a>';
                        echo '<a style="font-size:100%; color:black; align-self:flex-end; margin-top:10px">On ' . $date->format('jS F, Y') . '</a>';
                        echo '</div>';
                        echo '<hr>';
                    }
                }
                ?>
            </div>

            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { ?>
                <div style="width:calc(50% - 25px); background-color:rgba(255, 255, 255, 0.7)">
                    <h2 style="color:black;">Write a review</h2>
                    <a style="font-size:100%; color:black;">Share your thoughts about this product.</a>

                    <form action="" method="POST">
                        <textarea name="review" maxlength="250" rows="4" placeholder="Write Here!" style="color:black; width:calc(100% - 30px); resize:vertical;"></textarea>
                        <button type="submit" name="submit_review">Submit Review</button>
                    </form>
                </div>
                <?php
                if(isset($_POST['submit_review']) && isset($_POST['review'])) {
                    $review = connect()->real_escape_string($_POST['review']);

                    $sql = "SELECT userID, productID
                            FROM webshop.reviews
                            WHERE userID=".$_SESSION['userID']." AND productID=".$id;

                    $result = connect()->query($sql);

                    if(mysqli_num_rows($result) > 0) {
                        $sql = "UPDATE webshop.reviews SET
                                    review='".$review."',
                                    date=CURRENT_TIMESTAMP()
                                WHERE userID=".$_SESSION['userID']." AND productID=".$id;

                        connect()->query($sql);
                    } else {
                        $sql = "INSERT INTO webshop.reviews (review, productID, userID)
                        VALUES ('".$review."', '$id', '" . $_SESSION['userID'] . "')";

                        connect()->query($sql);
                    }

                    header('location: '.$_SERVER['REQUEST_URI']);
                    exit();
                }
            }
            ?>
        </div>

        <br>
    </body>
</html>
