<?php
  session_start();

  require_once __DIR__ . '/src/Cart.php';
  include('connection/connect.php');

  if(isset($_POST['ordersubmit'])) {
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
      echo "<script>if(confirm('Log In as a customer to order.')){document.location.href='login.php'};</script>";
    }
    elseif ($_SESSION["id"] !== 0) {
      echo "<script>if(confirm('Log In as a customer to order.')){document.location.href='login.php'};</script>";
      exit;
    }
    else {
      $ocemail = strval($_SESSION["email"]);

      $orname = $_POST['orname'];
      $result = $con->query("SELECT r_email FROM user_res WHERE r_name = '$orname'");
      while($row = mysqli_fetch_array($result)) {
        $oremail = $row['r_email'];
      }

      $omitem = $_POST['odish'];
      $oquan = $_POST['oquan'];
      $ocost = $_POST['ocost'];

      Cart::instance()->add($oremail, $omitem, $ocost, $oquan, [
          'veg_non_veg' => $_POST['dnonveg'],
          'restaurant_name' => $orname,
      ]);

      // Redirect, so refresh don't re-execute the same.
      header('Location: ' . $_SERVER['REQUEST_URI']);
      exit;

      //$query = "INSERT INTO orders(o_r_email, o_c_email, o_m_item, o_quan) VALUES ('$oremail','$ocemail', '$omitem', '$oquan')";
      //$result = mysqli_query($con, $query);

      // echo "<script>alert('Food Succesfully ordered. Details mailed to registered email.')</script>";
    }
  }

  // HTML content loaded later than scripts.
  include('navbar.php');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>FoodShala | Menu</title>
  </head>
  
    <style>
		.fixed_header th, .fixed_header td {
			width: 210px;
		}
		.table-fixed tbody {
			height: auto;
			max-height: 500px;
			overflow-y: auto;
			width: 100%;
		}
	</style>
	
    <body>

      <?php

        $query ="SELECT menu.m_item, user_res.r_name, menu.m_cost, menu.m_nonveg FROM menu INNER JOIN user_res ON menu.m_r_email=user_res.r_email ORDER BY menu.m_item";
        echo '<div style="padding-top: 100px; padding-bottom: 40px; padding-left: 16%; height: 800px;">
                <table class="table table-hover table-fixed fixed_header bg-light" style="width: 80%;" id="menubox">
                  <thead class="deep-orange white-text">
                    <tr>
                      <th>Dish</th>
                      <th>Restaurant</th>
                      <th>Cost</th>
                      <th>Veg/Non Veg</th>
                      <th>Quantity</th>
                      <th>Order here</th>
                    </tr>
                  </thead>
                  <tbody>';

        if ($result = $con->query($query)) {
          $rown = 1;
          while ($row = $result->fetch_assoc()) {
            $dish = $row["m_item"];
            $rname = $row["r_name"];
            $cost = $row["m_cost"];
            $nonvegcode = $row["m_nonveg"];

            if ($nonvegcode === '1') {
              $nonveg = "Non Veg";
            }
            else {
              $nonveg = "Veg";
            }

            echo '<form method="POST" id="orderform'.$rown.'" action="menu.php"></form>
                  <tr>
                    <td><input type="text" id="menu-field" name="odish" form="orderform'.$rown.'" value="'.$dish.'" readonly /></td>
                    <td><input type="text" id="menu-field" name="orname" form="orderform'.$rown.'" value="'.$rname.'" readonly /></td>
                    <td><input type="text" id="menu-field" name="ocost" form="orderform'.$rown.'" value="'.$cost.'" readonly /></td>
                    <td><input type="text" id="menu-field" name="dnonveg" form="orderform'.$rown.'" value="'.$nonveg.'" readonly /></td>
                    <td><input type="number" id="menu-field" name="oquan" min="1" form="orderform'.$rown.'" value="1" required /></td>
                    <td>
                      <center>
                        <input type="submit" class="btn btn-deep-orange" form="orderform'.$rown.'" value="ADD" name="ordersubmit"/>
                      </center>
                    </td>
                  </tr>';
            $rown = $rown + 1;
          }
          $result->free();
        }
      ?>
          </tbody>
        </table>
    </div>
    
  </body>
</html>
