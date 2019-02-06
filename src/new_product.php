<?php
include('connect.php');

if (isset($_POST['submit'])) {
$productName = mysqli_real_escape_string($conn, $_POST['productName']);
$prorductCatagory = mysqli_real_escape_string($conn, $_POST['prorductCatagory']);
$productPrice = mysqli_real_escape_string($conn, $_POST['$productPrice']);
$stock = mysqli_real_escape_string($conn, $_POST['stock']);


//Tjekker for tomme felter
if (empty($productName) || empty($prorductCatagory) || empty($productPrice) || empty($stock) ||  {
    header("location: ./new_product.php?=empty");
    exit();
} else if (!preg_match("/^[a-zA-Z]*$/", $productName) || !preg_match("/^[a-zA-Z]*$/", $prorductCatagory)) {
    header("Location: ./ProductName.php?=invalidproduct");
    exit();
} else if (!preg_match("/^[0-9]*$/", $productPrice)) {
    header("Location: ./new_product?price=Invalidprice");
    exit();
  } else if (!preg_match("/^[0-9]*$/", $stock)) {
      header("Location: ./new_product?price=Invalidprice");
      exit();
    // Får forbindels til databasen og får data med navne
} else {
    $sql = "SELECT * FROM webshop.product WHERE productName='$productName'";
    $result = $conn->query($sql);
    $resultCheck = mysqli_num_rows($result);

    // Tjekker for om navnet er taget i databasen
    if ($resultCheck > 0) {
        header("location: ./new_product.php?product=exist");
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        //Tilføj dataen i databasen
        $sql = "INSERT INTO webshop.brugere (ProductName, ProrductCatagory, Productprice, stock)
        VALUES ('$productName', '$ProrductCatagory', '$Productprice', '$Stock')";
        // Efter oprettelsen af bruger logger man ind
        if ($conn->query($sql) === false) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit();

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                exit();
            }
        }
    }
}
// Hvis man går ind på koden via URL kommer man tilbage til login.php
} else {
  header("location: ./productname.php");
  exit();
}
