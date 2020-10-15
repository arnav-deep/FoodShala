<?php

  include('head.php');

  // if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  //   echo "<script>hideLink('logout-btn')</script>";
  //   echo "<script>hideLink('editmenu-btn')</script>";
  //   echo "<script>showLink('login-btn')</script>";
  //   echo "<script>showLink('register-btn')</script>";
  // }
  // else {
  //   echo "<script>showLink('logout-btn')</script>";
  //   echo "<script>hideLink('login-btn')</script>";
  //   echo "<script>hideLink('register-btn')</script>";
  //   if ($_SESSION["id"] === 1) {
  //     echo "<script>showLink('editmenu-btn')</script>";
  //   }
  //   else {
  //     echo "<script>hideLink('editmenu-btn')</script>";
  //   }
  // }

?>

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

<nav class="mb-1 navbar navbar-expand-lg navbar-dark red lighten-1">
  <a class="navbar-brand" style="color: white;">FoodShala</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="menu.php">Menu</a>
      </li>

      <?php if(isset($_SESSION["loggedin"]) && $_SESSION["id"] === 1){ ?>
        <li class="nav-item" id="editmenu-btn" name="editmenu">
        <a class="nav-link" href="addmenuitem.php">Edit Menu</a>
      </li>
      <li class="nav-item" id="orders-btn" name="ordersmenu">
        <a class="nav-link" href="orders.php">Orders</a>
      </li>
      <?php
      }  ?>




      
      <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
        <li class="nav-item" id="logout-btn" name="logout">
        <a class="nav-link" href="logout.php">Log Out</a>
      </li> 
      <?php
      }else {?>
       <li class="nav-item" id="login-btn" name="login">
        <a class="nav-link" href="login.php">Log In</a>
      </li>
      <li class="nav-item" id="register-btn" name="register">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <?php
      }  ?>
    </ul>
  </div>
</nav>
