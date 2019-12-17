<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Utils;


class ShippingPackage {
    /**
     * @var string
     */
    public $pkgid;
    /**
     * @var string
     */
    public $carrier;
    /**
     * @var string
     */
    public $service;
    /**
     * @var double
     */
    public $weight;
    /**
     * @var double
     */
    public $length;
    /**
     * @var double
     */
    public $height;
    /**
     * @var double
     */
    public $width;
    /**
     * @var string
     */
    public $tracking_number;
    /**
     * @var double
     */
    public $freight;
}