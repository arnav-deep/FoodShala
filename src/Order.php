<?php


class Order
{
    /**
     * @param array $cart_items
     * @return integer|null
     */
    public static function place($cart_items){

        $total_amount = 0;
        foreach ( $cart_items as &$cart_item ){
            $cart_item['__amount'] = $cart_item['quantity'] * $cart_item['unit_cost'];
            $total_amount += $cart_item['__amount'];
        }

        $email = strval( $_SESSION["email"] );
        $order_time = date('Y-m-d H:i:s');

        // var_dump( $cart_items ); exit;

        global $con;

        try {

            // Start Transaction ----------
            $con->query("START TRANSACTION");

            // Create Order ---------------
            $stmt = $con->prepare("INSERT INTO `orders` SET `cust_email`=?, `amount`=?, created_at=?");
            $stmt->bind_param('sds', $email, $total_amount, $order_time);

            if( !$stmt->execute() ){
                throw new Exception( $stmt->error );
            }

            $order_id = $con->insert_id;

            // Add Order Items -------------
            $stmt = $con->prepare("
                    INSERT INTO `order_items`
                    SET `order_id`=?, `rest_email`=?, item_name=?,
                         item_qty=?, item_unit_cost=?, item_total_cost=?
             ");

            foreach ( $cart_items as &$cart_item ){
                $stmt->bind_param('issddd',
                    $order_id,
                    $cart_item['restaurant'],
                    $cart_item['name'],
                    $cart_item['quantity'],
                    $cart_item['unit_cost'],
                    $cart_item['__amount']
                );

                if(!$stmt->execute()){
                    throw new Exception( $stmt->error );
                }

            }

            // Commit All Changes --------
            $con->query("COMMIT");

            return $order_id;

        }catch (Exception $exception){
            // Rollback if any error occurs --------
            $con->query("ROLLBACK");
            // echo $exception->getMessage();
        }

        return null;

    }

}