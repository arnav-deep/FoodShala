<?php


class Customer
{

    public $name;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $non_veg;

    public function __construct($data = [])
    {
        if( isset( $data['c_name'] ) ) $this->name = $data['c_name'];
        if( isset( $data['c_email'] ) ) $this->email = $data['c_email'];
        if( isset( $data['c_pwd'] ) ) $this->password = $data['c_pwd'];
        if( isset( $data['c_phone'] ) ) $this->phone = $data['c_phone'];
        if( isset( $data['c_add'] ) ) $this->address = $data['c_add'];
        if( isset( $data['c_nonveg'] ) ) $this->non_veg = !!intval( $data['c_nonveg'] );
    }

}