<?php
  session_start();
  if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

    session_destroy();

//    $_SESSION["loggedin"] = false;
//    $_SESSION["id"] = -1;
//    $_SESSION["email"] = "";

    echo "<script>if(confirm('Logged out succesfully.')){document.location.href='login.php'};</script>";
    exit;
  }
  else {
    echo "<script>if(confirm('You are not even logged in. Log in first.')){document.location.href='login.php'};</script>";

  }

?>
