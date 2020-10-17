<?php
  session_start();
  include('connection/connect.php');
  include('navbar.php');

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "<script>alert('Already Logged In')</script>";
    header("location: menu.php");
    exit;
  }

?>
<!DOCTYPE html>
<html>
  <head>

    <link rel="stylesheet" href="css/style.css">
    <title>FoodShala | Log In</title>
  </head>
  <body style="rgba(90, 0, 0, 0.4)">

    <?php

      if(isset($_POST["cussubmit"])) {

        $cemail = $_POST["c_email"];
        $cpwd = $_POST["c_pwd"];

        $cemail_res = $con->query("SELECT * FROM user_cus WHERE c_email = '$cemail'");
        $cpwd_res = $con->query("SELECT * FROM user_cus WHERE c_pwd = '$cpwd' AND c_email = '$cemail'");

        if ($cemail_res->num_rows == 0) {
          echo "<script>alert('Email is not registered.')</script>";
        }
        elseif ($cpwd_res->num_rows == 0) {
          echo "<script>alert('Wrong Password')</script>";
        }
        else {
          session_start();

          $_SESSION["loggedin"] = true;
          $_SESSION["id"] = 0;
          $_SESSION["email"] = $cemail;

          header("location: menu.php");
        }

      }


      if(isset($_POST["ressubmit"])) {

        $remail = $_POST["r_email"];
        $rpwd = $_POST["r_pwd"];

        $remail_res = $con->query("SELECT * FROM user_res WHERE r_email = '$remail'");
        $rpwd_res = $con->query("SELECT * FROM user_res WHERE r_pwd = '$rpwd' AND r_email = '$remail'");

        if ($remail_res->num_rows == 0) {
          echo "<script>alert('Email is not registered.')</script>";
        }
        elseif ($rpwd_res->num_rows == 0) {
          echo "<script>alert('Wrong Password')</script>";
        }
        else {
          session_start();

          $_SESSION["loggedin"] = true;
          $_SESSION["id"] = 1;
          $_SESSION["email"] = $remail;

          header("location: orders.php");
        }

      }

    ?>


    <div id="outer-box">
      <div id="logform-box">
        <div id="regbutton-box">
          <div id="change-btn"></div>
          <button type="button" id="regtoggle-btn" onclick="to_cusreg()">Customer</button>
          <button type="button" id="regtoggle-btn" onclick="to_resreg()">Restaurant</button>
        </div>
        <form id="cus_reg" method="POST" action="login.php">
          <input type="email" id="reginput-field" placeholder="Email ID" name="c_email" required>
          <input type="password" id="reginput-field" placeholder="Enter Password" name="c_pwd" minlength="8" required>
          <br><br>
          <button type="submit" id="cussubmit-btn" name="cussubmit">Customer Log in</button>
        </form>

        <form id="res_reg" method="POST" action="login.php">
          <input type="email" id="reginput-field" placeholder="Email ID" name="r_email" required>
          <input type="password" id="reginput-field" placeholder="Enter Password" name="r_pwd" required>
          <br><br>
          <button type="submit" id="ressubmit-btn" name="ressubmit">Restaurant Log in</button>
        </form>
      </div>

    </div>

    <script>

      var reg_cus = document.getElementById("cus_reg");
      var reg_res = document.getElementById("res_reg");
      var btn_select = document.getElementById("change-btn");

      function to_resreg() {
        reg_cus.style.left = "-400px";
        reg_res.style.left = "50px";
        btn_select.style.left = "110px";
      }

      function to_cusreg() {
        reg_cus.style.left = "50px";
        reg_res.style.left = "450px";
        btn_select.style.left = "0";
      }
    </script>

  </body>
</html>
