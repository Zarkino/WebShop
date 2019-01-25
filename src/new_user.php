<?php
include('connect.php');

if (isset($_POST['submit'])) {
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$formue = mysqli_real_escape_string($conn, $_POST['formue']);

//Tjekker for tomme felter
if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password)) {
    header("location: ./login.php?=empty");
    exit();
} else if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)) {
    header("Location: ./login.php?=invalidname");
    exit();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ./login.php?signup=invalidemail");
    exit();
} else if (preg_match("/(admin)/", $username)) {
    header("Location: ./login.php?signup=invalidusername");
    exit();
    // Får forbindels til databasen og får data med navne
} else {
    $sql = "SELECT * FROM webshop.brugere WHERE username='$username'";
    $result = $conn->query($sql);
    $resultCheck = mysqli_num_rows($result);

    // Tjekker for om navnet er taget i databasen
    if ($resultCheck > 0) {
        header("location: ./login.php?singup=usertaken");
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        //Tilføj dataen i databasen
        $sql = "INSERT INTO webshop.brugere (Firstname, Lastname, Email, Username, Password, Formue)
        VALUES ('$firstname', '$lastname', '$email', '$username', '$hashed_password' , '$formue')";
        // Efter oprettelsen af bruger logger man ind
        if ($conn->query($sql) === false) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit();
        } else {
            $sql = "SELECT * FROM webshop.brugere WHERE username='$username'";
            if($result = $conn->query($sql)) {
                while($row = $result->fetch_assoc()) {
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["brugerID"] = $row['BrugerID'];
                    $_SESSION["firstname"] = $row['Firstname'];
                    $_SESSION["lastname"] = $row['Lastname'];
                    $_SESSION["username"] = $row['Username'];
                    $_SESSION["formue"] = $row['Formue'];
                    header("location: home.php");
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                exit();
            }
        }
    }
}
// Hvis man går ind på koden via URL kommer man tilbage til login.php
} else {
  header("location: ./login.php");
  exit();
}
