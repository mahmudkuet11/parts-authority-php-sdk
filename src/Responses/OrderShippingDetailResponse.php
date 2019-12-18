<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Responses;


use Illuminate\Support\Arr;
use Mahmud\PartsAuthority\Exceptions\InvalidPoException;
use Mahmud\PartsAuthority\Utils\ShippingPackage;

class OrderShippingDetailResponse extends Response {
    /**
     * @return mixed
     * @throws \JsonMapper_Exception
     */
    public function getShippingPackages() {
        $map = new \JsonMapper();
        $shippingPackages = $map->mapArray(\Mahmud\PartsAuthority\Utils\Arr::toObject(Arr::get($this->jsonArray, 'ShippingInfo')), [], ShippingPackage::class);
        return $shippingPackages;
    }
    
    public function handleFailure() {
        parent::handleFailure();
        
        if (!$this->isSuccessful()) {
            if (Arr::get($this->jsonArray, 'responseDetail') == "Invalid PO") {
                throw new InvalidPoException();
            }
        }
    }
}