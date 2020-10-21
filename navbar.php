<?php

  require_once 'src/Cart.php';
  include('head.php');

?>


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
      }
      ?>
    </ul>
    <ul class="navbar-nav ml-auto">
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="cart.php">
                    <i class="fas fa-shopping-cart mr-1"></i> Cart
                    <span class="badge badge-dark ml-1"><?php echo Cart::instance()->totalCount(); ?></span>
                </a>
            </li>
            <li class="nav-item" id="logout-btn" name="logout">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
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
