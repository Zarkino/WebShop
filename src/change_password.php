<?php
include('database.php');

if($_POST['subbmit'])
{

  $password = mysqli_real_escape_string(connect(), $_POST['password']);
  $newpassword = mysqli_real_escape_string(connect(), $_POST['newpassword']);
  $checkpassword = mysqli_real_escape_string(connect(), $_post['checkpassword']);

  $queryget = mysql_query("SELECT password FROM webshop.users WHERE username='$username'");

  $row = mysql_fetch_assoc($queryget);

  $oldpassword = $row['password'];

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
} else {
    die;
  }
}
 ?>
