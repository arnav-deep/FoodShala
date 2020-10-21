<?php


class OrderItem
{

    public $id;
    public $order_id;
    public $rest_email;
    public $item_name;
    public $item_qty;
    public $item_unit_cost;
    public $item_total_cost;


    /**
     * OrderItem constructor.
     * @param array $data
     */
    public function __construct($data = []){
        if( isset( $data['id'] ) ) $this->id = intval( $data['id'] );
        if( isset( $data['order_id'] ) ) $this->order_id = intval( $data['order_id'] );
        if( isset( $data['rest_email'] ) ) $this->rest_email = $data['rest_email'];
        if( isset( $data['item_name'] ) ) $this->item_name = $data['item_name'];
        if( isset( $data['item_qty'] ) ) $this->item_qty = floatval( $data['item_qty'] );
        if( isset( $data['item_unit_cost'] ) ) $this->item_unit_cost = floatval( $data['item_unit_cost'] );
        if( isset( $data['item_total_cost'] ) ) $this->item_total_cost = floatval( $data['item_total_cost'] );
    }

}