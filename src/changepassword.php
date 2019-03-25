<?php
include('database.php');

  $username=$_SESSION['username'] ;

//if   ($username){

if (isset($_POST['submit']))
{
echo"test";

  $oldpassword = mysqli_real_escape_string(connect(), $_POST['oldpassword']);
  $newpassword = mysqli_real_escape_string(connect(), $_POST['newpassword']);
  $test = mysqli_real_escape_string(connect(), $_post['test']);

  echo"$oldpassword/+ $newpassword/+ $test /+";
  echo"$confirmpassword/virker ik";

}
  /*$queryget = mysql_query("SELECT password FROM webshop.users WHERE username='$username'");

  $row = mysql_fetch_assoc($queryget);

  $oldpassword = $row['password'];
  echo"$password";
  echo"$newpassword";
  if ($password == $oldpassword)
{
  if ($newpassword==$checkpassword){

    $querychange = mysql_query("
    UPDATE webshop.users
    SET password='$newpassword'
    WHERE username='$username'
");
session_destroy();
  echo"You have changed your password";
  }else{
    die("new password did'nt match");
  }
} else {
  die("Current password is wrong");
}

}
*/ else {
    echo("failed");
  }
 ?>
