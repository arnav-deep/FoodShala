<?php
session_start();

//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

require_once __DIR__ . '/connection/connect.php';
require_once __DIR__ . '/src/Cart.php';
require_once __DIR__ . '/src/Order.php';


if( isset( $_GET['clear'] ) ){
    Cart::instance()->clear();
    header('Location: cart.php');
    exit;
}

if( isset( $_POST['place-order'] ) ){
    $items = Cart::instance()->allByItems();
    $order_id = Order::place($items);

    if( $order_id ){ // If order is successful

        // Clear all cart contents.
        Cart::instance()->clear();

        // TODO: Send the email here.

        ?>
        <script>
            alert("Food Succesfully ordered. Details mailed to registered email.");
            window.location = 'menu.php';
        </script>
        <?php

        exit;
    }
}


include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>FoodShala | Your Cart</title>
</head>

<style>
</style>

<body>
<?php $items = Cart::instance()->allByItems();?>
<div class="container">

    <form action="./cart.php" method="post">
        <input type="hidden" name="place-order">

        <table class="table table-hover table-fixed bg-light mt-5">
            <thead class="deep-orange white-text">
            <tr>
                <th>Dish</th>
                <th>Veg / Non-Veg</th>
                <th>Restaurant</th>
                <th>Quantity</th>
                <th class="text-right">Cost</th>
            </tr>
            </thead>
            <tbody>

            <?php if (empty( $items )): ?>
            <tr>
                <td colspan="2">No items in cart.</td>
            </tr>
            <?php endif; ?>

            <?php foreach ( $items as $item ): ?>
            <tr>
                <th><?php echo $item['name']; ?></th>
                <th><?php echo $item['meta']['veg_non_veg']; ?></th>
                <th><?php echo $item['meta']['restaurant_name']; ?></th>
                <th><?php echo $item['quantity']; ?></th>
                <th class="text-right"><?php echo number_format( $item['unit_cost'] * $item['quantity'] ); ?></th>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-warning">
                <th colspan="3">TOTAL</th>
                <th><?php echo number_format( Cart::instance()->totalCount() ); ?></th>
                <th class="text-right"><?php echo number_format( Cart::instance()->totalAmount() ); ?></th>
            </tr>
            </tbody>
        </table>

        <hr>

        <?php if ( empty( $items ) ): ?>
            <a href="./menu.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Menu</a>
        <?php else: ?>
        <div class="row">
            <div class="col-6"><a href="?clear" class="btn btn-danger">Clear</a></div>
            <div class="col-6 text-right"><button type="submit" class="btn btn-primary">Place Order</button></div>
        </div>
        <?php endif; ?>

    </form>

    <!-- For Debugging Only  -->
<!--    <pre>--><?php //print_r( $items ); ?><!--</pre>-->
    <!-- ------------------  -->

</div>
</body>
</html>
