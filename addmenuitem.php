<?php
  session_start();
  include('connection/connect.php');
  include('navbar.php');

  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
  }
  elseif ($_SESSION["id"] !== 1) {
    echo "<script>if(confirm('Only Restaurant Admins can edit menu.')){document.location.href='menu.php'};</script>";
    exit;
  }
  else {
    $mremail = strval($_SESSION["email"]);
  }
?>

<!DOCTYPE html>
<html>
  <head>

    <link rel="stylesheet" href="css/style.css">
    <title>FoodShala | Add Menu Item</title>
  </head>
  <body>

    <?php

      if(isset($_POST['cussubmit'])) {

        $mremail = $_SESSION["email"];
        $mitem = $_POST['m_item'];
        $mcost = $_POST['m_cost'];

        if ($_POST['m_nonveg'] == '0') {
          $mnonveg = 0;
        }
        else {
          $mnonveg = 1;
        }

        $query = "INSERT INTO menu(m_r_email, m_item, m_cost, m_nonveg) VALUES ('$mremail', '$mitem', '$mcost', '$mnonveg')";
        $result = mysqli_query($con, $query);
      }

    ?>


    <div id="outer-box">
      <div id="menuform-box">
        <div id="boxtitle">
          <?php

            $result = $con->query("SELECT r_name FROM user_res WHERE r_email = '$mremail'");
            while($row = mysqli_fetch_array($result)) {
              $rname = $row['r_name'];
            }
            echo "<center><h1>".$rname."'s Menu</h1></center>";
          ?>
        </div>
        <form id="menu_reg" method="POST" action="addmenuitem.php">
          <input type="text" id="reginput-field" placeholder="Name of the dish" name="m_item" required>
          <input type="number" id="reginput-field" placeholder="Cost" name="m_cost" required>
          <input type="radio" id="regcheck-box" name="m_nonveg" value="0" required><label id="checkbox-veg">Veg</label>
          <input type="radio" id="regcheck-box" name="m_nonveg" value="1" required><label id="checkbox-nonveg">Non-Veg</label>
          <button type="submit" id="cussubmit-btn" name="cussubmit">Add Item</button>
        </form>
      </div>

    </div>

  </body>
</html>
