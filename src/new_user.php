<?php
include('database.php');

if (isset($_POST['submit'])) {
    $url = $_POST['url'];

    //For guests
    if(!isset($_POST['username'])) {
        $username = $_POST['firstname'];
    } else {
        $username = mysqli_real_escape_string(connect(), $_POST['username']);
    }

    //For guests
    if(!isset($_POST['balance'])) {
        $balance = 1000;
    } else {
        $balance = mysqli_real_escape_string(connect(), $_POST['balance']);
    }

    //For guests
    if(!isset($_POST['password'])) {
        $password = generateRandomPassword();
    } else {
        $password = mysqli_real_escape_string(connect(), $_POST['password']);
    }

    $firstname = mysqli_real_escape_string(connect(), $_POST['firstname']);
    $lastname = mysqli_real_escape_string(connect(), $_POST['lastname']);
    $email = mysqli_real_escape_string(connect(), $_POST['email']);

    if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password)) {
        //header('location: '.$url.'?=empty');
        echo $firstname;
        echo $lastname;
        echo $email;
        echo $username;
        echo $password;
        echo $balance;
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

          $msg = "Welcome to our webshop
          \nyour username and password is
          \nUsername: $username
          \nPassword: $password" ;

          // use wordwrap() if lines are longer than 70 characters
          $msg = wordwrap($msg,70);

          // send email
          mail($email,"Account created",$msg);

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
