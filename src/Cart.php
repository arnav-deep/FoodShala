<?php


class Cart
{

    protected static $instance = null;
    const SESSION = 'cart';

    /**
     * Helper for singleton class.
     *
     * @return static
     */
    public static function instance(){
        if( !static::$instance ){
            static::$instance = new static();
        }

        return static::$instance;
    }


    /**
     * Cart constructor.
     */
    public function __construct(){
        if( !isset( $_SESSION[ static::SESSION ] ) OR !is_array($_SESSION[ static::SESSION ]) ){
            $_SESSION[ static::SESSION ] = [];
        }
    }


    /**
     * Add an item to cart.
     *
     * @param $restaurant
     * @param $item_name
     * @param float $unit_cost
     * @param int $item_quantity
     * @param mixed|null $meta
     * @return Cart
     */
    public function add($restaurant, $item_name, $unit_cost, $item_quantity = 1, $meta = null){
        if( isset( $_SESSION[ static::SESSION ][ $restaurant ][ $item_name ][ 'quantity' ] ) ){
            $item_quantity += $_SESSION[ static::SESSION ][ $restaurant ][ $item_name ][ 'quantity' ];
        }
        $this->update($restaurant, $item_name, $unit_cost, $item_quantity, $meta);
        return $this;
    }


    /**
     * Update an item in cart.
     *
     * @param string $restaurant
     * @param string $item_name
     * @param float $unit_cost
     * @param int $item_quantity
     * @param mixed|null $meta
     * @return Cart
     */
    public function update($restaurant, $item_name, $unit_cost, $item_quantity, $meta = null){

        $unit_cost = floatval( $unit_cost );
        $item_quantity = floatval( $item_quantity );

        if( !isset( $_SESSION[ static::SESSION ][ $restaurant ] ) ){
            $_SESSION[ static::SESSION ][ $restaurant ] = [];
        }

        if( $item_quantity <= 0 and isset(  $_SESSION[ static::SESSION ][ $restaurant ][ $item_name ] ) ){
            unset( $_SESSION[ static::SESSION ][ $restaurant ][ $item_name ] );
        }else{
            $_SESSION[ static::SESSION ][ $restaurant ][ $item_name ] = [
                'quantity' => $item_quantity,
                'unit_cost' => $unit_cost,
            ];

            if(!is_null( $meta )){
                $_SESSION[ static::SESSION ][ $restaurant ][ $item_name ]['meta'] = $meta;
            }

        }

        if( empty( $_SESSION[ static::SESSION ][ $restaurant ] ) ){
            unset( $_SESSION[ static::SESSION ][ $restaurant ] );
        }

        return $this;
    }

    /**
     * @param $restaurant
     * @param $item_name
     * @return Cart
     */
    public function remove($restaurant, $item_name){
        $this->update($restaurant, $item_name, 0);
        return $this;
    }

    /**
     * @return Cart
     */
    public function clear(){
        $_SESSION[ static::SESSION ] = [];
        return $this;
    }


    /**
     * Get all cart items.
     * @return array[]
     */
    public function getItemsByRestaurants(){
        $c = [];
        foreach ($_SESSION[ static::SESSION ] as $restaurant => $items){
            $i = [];
            foreach ($items as $item => $detail){
                $i[] = [
                    'name' => $item,
                    'quantity' => $detail['quantity'],
                    'unit_cost' => $detail['unit_cost'],
                    'meta' => isset( $detail['meta'] ) ? $detail['meta'] : null,
                ];
            }

            $c[] = [
                'restaurant' => $restaurant,
                'items' => $i,
            ];
        }
        return $c;
    }

    /**
     * Get all cart items.
     * @return array[]
     */
    public function allByItems(){
        $i = [];
        foreach ($_SESSION[ static::SESSION ] as $restaurant => $items){
            foreach ($items as $item => $detail){
                $i[] = [
                    'restaurant' => $restaurant,
                    'name' => $item,
                    'quantity' => $detail['quantity'],
                    'unit_cost' => $detail['unit_cost'],
                    'meta' => isset( $detail['meta'] ) ? $detail['meta'] : null,
                ];
            }
        }
        return $i;
    }


    /**
     * Get all cart items.
     * @return array[]
     */
    public function totalCount(){
        $total = 0;
        foreach ($_SESSION[ static::SESSION ] as $restaurant => $items){
            foreach ($items as $detail){
                $total += $detail['quantity'];
            }
        }
        return $total;
    }

    public function totalAmount(){
        $total = 0;
        foreach ($_SESSION[ static::SESSION ] as $restaurant => $items){
            foreach ($items as $detail){
                $total += $detail['quantity'] * $detail['unit_cost'];
            }
        }
        return $total;
    }

    /**
     * @param $restaurant
     * @return array
     *
     * Get cart items of a specific restaurant.
     */
    public function itemsOfRestaurant($restaurant){
        if( !isset( $_SESSION[ static::SESSION ][ $restaurant ] ) ){
            return [];
        }

        $items = [];
        foreach ($_SESSION[ static::SESSION ][ $restaurant ] as $item => $detail){
            $items[] = [
                'name' => $item,
                'quantity' => $detail['quantity'],
                'unit_cost' => $detail['unit_cost'],
                'meta' => isset( $detail['meta'] ) ? $detail['meta'] : null,
            ];
        }

        return $items;
    }


}