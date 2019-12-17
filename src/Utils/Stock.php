<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Utils;


class Stock {
    /**
     * @var int
     */
    public $gastock;
    /**
     * @var int
     */
    public $houstock;
    /**
     * @var int
     */
    public $bxstock;
    /**
     * @var int
     */
    public $dcstock;
    /**
     * @var int
     */
    public $sflstock;
    /**
     * @var int
     */
    public $instock;
    /**
     * @var int
     */
    public $dfwstock;
    /**
     * @var int
     */
    public $castock;
    /**
     * @var int
     */
    public $bystock;
    /**
     * @var int
     */
    public $nystock;
    /**
     * @var int
     */
    public $ohstock;
    /**
     * @var int
     */
    public $ncstock;
    /**
     * @var int
     */
    public $wastock;
    /**
     * @var int
     */
    public $orstock;
    /**
     * @var int
     */
    public $azstock;
    /**
     * @var int
     */
    public $venstock;
    /**
     * @var int
     */
    public $frstock;
    /**
     * @var int
     */
    public $scstock;
    
    /**
     * @var string
     */
    public $sfran;
    /**
     * @var double
     */
    public $price;
    /**
     * @var double
     */
    public $core;
    /**
     * @var string
     */
    public $spart;
    
    /**
     * @return double
     */
    public function getTotalPrice() {
        return $this->price + $this->core;
    }
    
    /**
     * @return bool
     */
    public function isAvailable() {
        if($this->instock > 0){
            return true;
        }
        
        return false;
    }
}