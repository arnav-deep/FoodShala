<?php

require_once __DIR__ . '/OrderItem.php';
require_once __DIR__ . '/Customer.php';

class Order
{

    public $id;
    public $cust_email;
    public $amount;
    public $created_at;

    // Used for caching.
    protected $customer = false;
    protected $items = false;

    /**
     * Order constructor.
     * @param array $data
     */
    public function __construct($data = []){
        if( isset( $data['id'] ) ) $this->id = intval( $data['id'] );
        if( isset( $data['cust_email'] ) ) $this->cust_email = $data['cust_email'];
        if( isset( $data['amount'] ) ) $this->amount = floatval( $data['amount'] );
        if( isset( $data['created_at'] ) ) $this->created_at = DateTime::createFromFormat( 'Y-m-d H:i:s', $data['created_at'] );
    }


    public function number(){
        return strtoupper( dechex( $this->id ) );
    }


    /**
     * @param false $forcedUpdate
     * @return Customer|null
     */
    public function customer( $forcedUpdate = false ){

        global $con;

        if( $this->customer === false OR $forcedUpdate ){
            $stmt = $con->prepare("SELECT * FROM `user_cus` WHERE `c_email`=? LIMIT 1");
            $stmt->bind_param('s', $this->cust_email);

            $this->customer = null;

            if( $stmt->execute() ){
                $result = $stmt->get_result();
                if( $result ){
                    $this->customer = new Customer( $result->fetch_assoc() );
                }
            }

        }

        return $this->customer;

    }


    /**
     * @param null $restaurant_email
     * @param false $forcedUpdate
     * @return array|OrderItem[]
     */
    public function items( $restaurant_email = null, $forcedUpdate = false ){

        global $con;

        if( $this->items === false OR $forcedUpdate ){
            if( $restaurant_email ){
                $stmt = $con->prepare("SELECT * FROM `order_items` WHERE `order_id`=? AND `rest_email`=?");
                $stmt->bind_param('is', $this->id, $restaurant_email);
            }else{
                $stmt = $con->prepare("SELECT * FROM `order_items` WHERE `order_id`=?");
                $stmt->bind_param('i' , $this->id);
            }

            $this->items = [];
            if( $stmt->execute() ){
                $result = $stmt->get_result();
                if( $result ){
                    while ( $item = $result->fetch_assoc() ){
                        $this->items[] = new OrderItem( $item );
                    }
                }
            }

        }

        return $this->items;

    }

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


    /**
     * @param $restaurant_email
     * @return array|Order[]
     * @throws Exception
     */
    public static function getByRestaurant($restaurant_email){
        global $con;

        $sql = "
            SELECT `orders`.* FROM `orders` INNER JOIN `order_items`
            ON( `orders`.`id` = `order_items`.`order_id` )
            WHERE `order_items`.`rest_email` =? GROUP BY `orders`.`id` ORDER BY `orders`.`id` DESC
        ";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $restaurant_email);
        if( !$stmt->execute() ){
            throw new Exception( $stmt->error );
        }

        $result = $stmt->get_result();
        $orders = [];

        while( $order = $result->fetch_assoc() ){
            $orders[] = new static( $order );
        }

        return $orders;
    }

}