<?php
include('database.php');

if (isset($_POST['submit'])) {
    $name = connect()->real_escape_string($_POST['name']);
    $image = connect()->real_escape_string($_POST['image']);
    $category = connect()->real_escape_string($_POST['category']);
    $price = connect()->real_escape_string($_POST['price']);
    $stock = connect()->real_escape_string($_POST['stock']);

    //Tjekker for tomme felter
    if (empty($name) || empty($category) || empty($price) || empty($stock)) {
        header("location: ./new_product.php?=empty");
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $name) || !preg_match("/^[a-zA-Z]*$/", $category)) {
        header("location: ./ProductName.php?=Invalidproduct");
        exit();
    } else if (!preg_match("/^[0-9]*$/", $price)) {
        header("location: ./new_product?price=Invalidprice");
        exit();
    } else if (!preg_match("/^[0-9]*$/", $stock)) {
        header("location: ./new_product?price=Invalidprice");
        exit();
    } else {
        $sql = "SELECT * FROM webshop.products WHERE name=".$name;
        $result = connect()->query($sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            header("location: ./new_product.php?product=exist");
            exit();
        } else {
            $sql = "INSERT INTO webshop.products (name, image, category, price, stock)
          VALUES ('$name', null, '$category', '$price', '$stock')";

            if (!connect()->query($sql)) {
                echo 'Error: ' . connect()->error;
                exit();
            }
        }
    }
}
header("location: home.php");
exit();
?>
