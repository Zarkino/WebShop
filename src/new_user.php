<?php
include('database.php');

if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string(connect(), $_POST['firstname']);
    $lastname = mysqli_real_escape_string(connect(), $_POST['lastname']);
    $email = mysqli_real_escape_string(connect(), $_POST['email']);
    $username = mysqli_real_escape_string(connect(), $_POST['username']);
    $password = mysqli_real_escape_string(connect(), $_POST['password']);
    $balance = mysqli_real_escape_string(connect(), $_POST['balance']);

    if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password)) {
        header("location: ./signup.php?=empty");
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)) {
        header("Location: ./signup.php?=invalidname");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ./signup.php?signup=invalidemail");
        exit();
    } else if (preg_match("/(admin)/", $username)) {
        header("Location: ./signup.php?signup=invalidusername");
        exit();
    } else {
        $sql = "SELECT * FROM webshop.users WHERE email='$email'";
        $result = connect()->query($sql);

    // Tjekker for om emailen er taget i databasen (om der er flere end 0)
        if (mysqli_num_rows($result) > 0) {
            header("location: ./signup.php?signup=usertaken");
            exit();
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO webshop.users (firstname, lastname, email, username, password, balance)
          VALUES ('$firstname', '$lastname', '$email', '$username', '$hashed_password' , '$balance')";

            if (!connect()->query($sql)) {
                echo "Error: " . $sql . "<br>" . connect()->error;
                exit();
            } else {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["firstname"] = $firstname;
                $_SESSION["lastname"] = $lastname;
                $_SESSION["username"] = $username;
                $_SESSION["balance"] = $balance;

                header("location: home.php");
            }
        }
    }
}

header("location: signup.php");
exit();
?>