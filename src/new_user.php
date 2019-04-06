<?php
include('database.php');

if (isset($_POST['submit'])) {
    $url = $_POST['url'];

    $firstname = connect()->real_escape_string($_POST['firstname']);
    $lastname = connect()->real_escape_string($_POST['lastname']);
    $email = connect()->real_escape_string($_POST['email']);
    $balance = 5000;

    //For guests
    if(!isset($_POST['username'])) {
        $username = $firstname;
    } else {
        $username = connect()->real_escape_string($_POST['username']);
    }

    //For guests
    if(!isset($_POST['password'])) {
        $password = generateRandomPassword();
    } else {
        $password = connect()->real_escape_string($_POST['password']);
    }

    if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password)) {
        header('location: '.$url.'?=empty');
        exit();
    } else if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)) {
        header('location: '.$url.'?=invalidname');
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: '.$url.'?=invalidemail');
        exit();
    } else if (preg_match("/(admin)/", $username)) {
        header('location: '.$url.'?=invalidusername');
        exit();
    } else {
        $sql = "SELECT * FROM webshop.users WHERE email='$email'";
        $result = connect()->query($sql);

        // Tjekker for om emailen er taget i databasen (om der er flere end 0)
        if (mysqli_num_rows($result) > 0) {
            header('location: '.$url.'?=emailtaken');
            exit();
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO webshop.users (firstname, lastname, email, username, password, balance)
          VALUES ('$firstname', '$lastname', '$email', '$username', '$hashed_password' , '$balance')";


            sendMail("Welcome to our webshop
            \nyour username and password is
            \nUsername: $username
            \nPassword: $password", "Account Created", $email);

            if (!connect()->query($sql)) {
                echo "Error: " . $sql . "<br>" . connect()->error;
                exit();
            } else {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['userID'] = connect()->insert_id;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['username'] = $username;
                $_SESSION['balance'] = $balance;

                header('location: '.$url.'');
            }
        }
    }
}
/*
header("location: signup.php");
exit();
*/
?>
