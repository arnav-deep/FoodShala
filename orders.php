<?php
  session_start();
  include('connection/connect.php');
  include('navbar.php');

  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
  }
  elseif ($_SESSION["id"] !== 1) {
    echo "<script>if(confirm('Only Restaurants can view the orders.')){document.location.href='menu.php'};</script>";
    exit;
  }
  else {
    $mremail = strval($_SESSION["email"]);
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>FoodShala | Orders</title>
  </head>
    
	<style>
	  .fixed_header th, .fixed_header td {
		width: 260px;
	  }
	</style>
	
    <body>

      <?php

        $result = $con->query("SELECT r_name FROM user_res WHERE r_email = '$mremail'");
        while($row = mysqli_fetch_array($result)) {
          $rname = $row['r_name'];
        }
        echo "<br><br><center><h1>Orders of ".$rname."</h1></center>";
      ?>

      <?php

        $query ="SELECT orders.o_m_item, orders.o_quan, user_cus.c_name, user_cus.c_phone, user_cus.c_add FROM orders INNER JOIN user_cus ON orders.o_c_email=user_cus.c_email WHERE orders.o_r_email = '$mremail'";
        echo '<div style="display: block; padding-top: 50px; padding-bottom: 40px; padding-left: 16%; max-height: 100px;">
                <table class="table table-hover table-fixed fixed_header" style="width: 80%;" id="menubox">
                  <thead class="deep-orange white-text">
                    <tr>
                      <th>Dish</th>
                      <th>Quantity</th>
                      <th>Customer Name</th>
                      <th>Contact</th>
                      <th>Address</th>
                    </tr>
                  </thead>
                  <tbody>';

        if ($result = $con->query($query)) {
          while ($row = $result->fetch_assoc()) {
            $dish = $row["o_m_item"];
            $cquan = $row["o_quan"];
            $cname = $row["c_name"];
            $cphone = $row["c_phone"];
            $cadd = $row["c_add"];

            echo '<tr style="text-align: center">
                    <td>'.$dish.'</td>
                    <td>'.$cquan.'</td>
                    <td>'.$cname.'</td>
                    <td>'.$cphone.'</td>
                    <td>'.$cadd.'</td>
                  </tr>';
          }
          $result->free();
        }
      ?>
          </tbody>
        </table>
    </div>
  </body>
</html>
