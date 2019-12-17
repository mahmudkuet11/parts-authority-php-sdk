<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Requests;


class OrderHeader {
    public $cust_name;
    public $order_num;
    public $ship_add1;
    public $ship_add2;
    public $ship_city;
    public $ship_state;
    public $ship_zip;
    public $ship_country;
    public $ship_meth;
    
    /**
     * OrderHeader constructor.
     *
     * @param $cust_name
     * @param $order_num
     * @param $ship_add1
     * @param $ship_add2
     * @param $ship_city
     * @param $ship_state
     * @param $ship_zip
     * @param $ship_country
     * @param $ship_meth
     * @param $status
     */
    public function __construct($cust_name, $order_num, $ship_add1, $ship_add2, $ship_city, $ship_state, $ship_zip, $ship_country, $ship_meth) {
        $this->cust_name = $cust_name;
        $this->order_num = $order_num;
        $this->ship_add1 = $ship_add1;
        $this->ship_add2 = $ship_add2;
        $this->ship_city = $ship_city;
        $this->ship_state = $ship_state;
        $this->ship_zip = $ship_zip;
        $this->ship_country = $ship_country;
        $this->ship_meth = $ship_meth;
    }
    
    public function toArray() {
        return [
            'cust_name'    => $this->cust_name,
            'order_num'    => $this->order_num,
            'ship_add1'    => $this->ship_add1,
            'ship_add2'    => $this->ship_add2,
            'ship_city'    => $this->ship_city,
            'ship_state'   => $this->ship_state,
            'ship_zip'     => $this->ship_zip,
            'ship_country' => $this->ship_country,
            'ship_meth'    => $this->ship_meth,
        ];
    }
}