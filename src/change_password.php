<?php
include('database.php');

$password = mysqli_real_escape_string(connect(), $_POST['password']);
$newpassword = mysqli_real_escape_string(connect(), $_POST['newpassword']);
$checkpassword = mysqli_real_escape_string(connect(), $_post['checkpassword']);


if{
    $_SESSION['loggedin'] = true;
    $_SESSION["userID"] = $row['userID'];

function password($password) {
  $sql = "SELECT * FROM webshop.users WHERE ID = ".$_SESSION['userID']." LIMIT 1";

  $stmt = connect()->prepare($sql);

  $stmt->bind_param('s', $username);

  $stmt->execute();

  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()) {
      if(password_verify($password, $row['password'])) {


     $sql = "UPDATE webshop.users
     SET password ='$newpassword'
     WHERE userID = $row['userID']";


}
} else {
    die;
  }
}
 ?>
