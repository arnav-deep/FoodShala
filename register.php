<?php
  session_start();
  include('connection/connect.php');
  include('navbar.php');

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "<script>alert('Log Out to regsiter.')</script>";
    header("location: menu.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>
  <head>

    <link rel="stylesheet" href="css/style.css">
    <title>FoodShala | Register with Us</title>
  </head>
  <body>

    <!-- <script>

      function hideLink(id) {
        var elem = document.getElementById(id);
        elem.style.visibility = 'hidden';
      }

      function showLink(id) {
        var elem = document.getElementById(id);
        elem.style.visibility = 'visible';
      }

    </script> -->

    <?php

      if(isset($_POST['cussubmit'])) {

        $cname = $_POST['c_name'];
        $cemail = $_POST['c_email'];
        $cphone = $_POST['c_phone'];
        $cpwd = $_POST['c_pwd'];
        // $ccpwd = $_POST['c_cpwd'];
        $cadd = $_POST['c_add'];

        if ($_POST['c_nonveg'] == '0') {
          $cnonveg = 0;
        }
        else {
          $cnonveg = 1;
        }

        // if ($cpwd != $ccpwd) {

        // }
        // else {
          $query = "INSERT INTO user_cus(c_name, c_email, c_pwd, c_phone, c_add, c_nonveg) VALUES ('$cname','$cemail', '$cpwd', '$cphone', '$cadd', '$cnonveg')";
          $result = mysqli_query($con, $query);
          echo "<script>alert('Customer Registered Succesfully')</script>";
          // if (!$insert) {
          //   echo mysqli_error();
          // }
          // else {
          //   echo "Records added succesfully.";
          // }
        // }
      }


      if(isset($_POST['ressubmit'])) {

        $rname = $_POST['r_name'];
        $remail = $_POST['r_email'];
        $rphone = $_POST['r_phone'];
        $rphone2 = $_POST['r_phone2'];
        $rpwd = $_POST['r_pwd'];
        // $rcpwd = $_POST['r_cpwd'];
        $radd = $_POST['r_add'];

        // if ($cpwd != $ccpwd) {
        //   echo "<script>alert('Passwords don't match)</script>";
        // }
        // else {
          $query = "INSERT INTO user_res(r_name, r_email, r_pwd, r_add, r_phone1, r_phone2) VALUES ('$rname','$remail', '$rpwd', '$radd', '$rphone', '$rphone2')";
          $result = mysqli_query($con, $query);
          echo "<script>alert('Restaurant Registered Succesfully')</script>";
          // if (!$insert) {
          //   echo mysqli_error();
          // }
          // else {
          //   echo "Records added succesfully.";
          // }
        // }
      }

    ?>


    <div id="outer-box">
      <div id="regform-box">
        <div id="regbutton-box">
          <div id="change-btn"></div>
          <button type="button" id="regtoggle-btn" onclick="to_cusreg()">Customer</button>
          <button type="button" id="regtoggle-btn" onclick="to_resreg()">Restaurant</button>
        </div>
        <form id="cus_reg" method="POST" action="register.php">
          <input type="text" id="reginput-field" placeholder="Name" name="c_name" required>
          <input type="email" id="reginput-field" placeholder="Email ID" name="c_email" required>
          <input type="text" id="reginput-field" placeholder="Phone Number" name="c_phone" minlength="10" maxlength="10" required>
          <input type="password" id="reginput-field" placeholder="Enter Password" name="c_pwd" minlength="8" required>
          <!-- <input type="password" id="reginput-field" placeholder="Confirm Password" name="c_cpwd" required> -->
          <input type="text" id="reginput-field" placeholder="Address" name="c_add" required>
          <input type="radio" id="regcheck-box" name="c_nonveg" value="0" required><label id="checkbox-veg">Veg</label>
          <input type="radio" id="regcheck-box" name="c_nonveg" value="1" required><label id="checkbox-nonveg">Non-Veg</label>
          <button type="submit" id="cussubmit-btn" name="cussubmit">Regsiter as Customer</button>
        </form>

        <form id="res_reg" method="POST" action="register.php">
          <input type="text" id="reginput-field" placeholder="Name" name="r_name" required>
          <input type="email" id="reginput-field" placeholder="Email ID" name="r_email" required>
          <input type="text" id="reginput-field" placeholder="Phone Number" name="r_phone" minlength="10" maxlength="10" required>
          <input type="text" id="reginput-field" placeholder="Another Phone Number" name="r_phone2" minlength="10" maxlength="10">
          <input type="password" id="reginput-field" placeholder="Enter Password" name="r_pwd" minlength="8" required>
          <!-- <input type="password" id="reginput-field" placeholder="Confirm Password" required> -->
          <input type="text" id="reginput-field" placeholder="Address" name="r_add" required>
          <br><br>
          <button type="submit" id="ressubmit-btn" name="ressubmit">Regsiter as Restaurant</button>
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
