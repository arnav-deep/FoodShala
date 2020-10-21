<?php
  session_start();
  require_once __DIR__ . '/src/Order.php';
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
	.table-fixed tbody {
		height: auto;
		max-height: 600px;
		overflow-y: auto;
		width: 100%;
	}
</style>

<body>

<!--      --><?php
//
//        echo "<pre>";
//        $orders = Order::getByRestaurant( $mremail );
//        foreach ( $orders as $order ){
//            $items = $order->items( $mremail );
//        }
//        exit;
//
//
//        $result = $con->query("SELECT r_name FROM user_res WHERE r_email = '$mremail'");
//        while($row = mysqli_fetch_array($result)) {
//          $rname = $row['r_name'];
//        }
//        echo "<br><br><center><h1>Orders of ".$rname."</h1></center>";
//      ?>

    <div class="container">
		
		<div id="boxtitle" style="color: white;">
			<?php
				$result = $con->query("SELECT r_name FROM user_res WHERE r_email = '$mremail'");
				while($row = mysqli_fetch_array($result)) {
				  $rname = $row['r_name'];
				}
				echo "<center><h1>".$rname."'s Menu</h1></center>";

				$orders = Order::getByRestaurant( $mremail );
			?>
		</div>

        <table class="table table-hover table-fixed fixed_header bg-light mt-5">
			<thead class="deep-orange white-text">
				<th class="font-weight-bold">Order ID</th>
				<th class="font-weight-bold">Customer</th>
				<th class="font-weight-bold">Customer Number</th>
				<th class="font-weight-bold">Address</th>
				<th class="font-weight-bold">Total</th>
				<th class="font-weight-bold">Order Time</th>
			</thead>
            <tbody>

            <?php if (empty( $orders )): ?>
                <tr>
                    <td colspan="4">No orders present.</td>
                </tr>
            <?php endif; ?>

            <?php
                foreach ( $orders as $index => $order ):
                    $customer = $order->customer();
                    $items = $order->items( $mremail );
            ?>
                <tr>
                    <th class="text-left font-weight-bold" width="100">#<?php echo $order->number(); ?></th>
                    <th class="font-weight-bold" width="200"><?php echo $customer->name; ?></th>
                    <th class="font-weight-bold"><?php echo $customer->phone; ?></th>
                    <th class="text-left font-weight-bold"><?php echo $customer->address; ?></th>
                    <th class="text-right font-weight-bold" width="100"><?php echo number_format( $order->amount ); ?></th>
                    <th class="font-weight-bold"><?php echo $order->created_at->format('d M, Y | h:i a'); ?></th>
                </tr>
                <tr>
                    <td colspan="6" style="height: auto; padding: 2px 0;">
                        <hr class="my-0">
                    </td>
                </tr>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td colspan="2"></td>
                        <td class="text-left"><?php echo $item->item_name; ?></td>
                        <td><?php echo $item->item_qty; ?></td>
                        <td class="text-right"><?php echo number_format( $item->item_total_cost ); ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( $index != count( $orders ) - 1 ): ?>
                <tr>
                    <td colspan="6" style="height: auto; padding: 2px 0;">
                        <hr class="my-2" style="border-width: 5px">
                    </td>
                </tr>
                <?php endif; ?>

            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
	
	<!-- For debugging only -->
	<!-- <pre> --><?php //var_dump( Cart::instance()->all() ); ?> <!-- </pre> -->
	
</body>
</html>
