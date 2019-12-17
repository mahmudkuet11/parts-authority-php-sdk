<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Responses;


use Mahmud\PartsAuthority\Exceptions\InvalidPoException;
use Mahmud\PartsAuthority\Utils\Arr;
use Mahmud\PartsAuthority\Utils\OrderInformation;

class GetOrderInformationResponse extends Response {
    /**
     * @return mixed
     * @throws \JsonMapper_Exception
     */
    public function getOrderInformation() {
        $map = new \JsonMapper();
        return $map->mapArray(Arr::toObject($this->jsonArray), [], OrderInformation::class);
    }
    
    /**
     * @throws InvalidPoException
     * @throws \Mahmud\PartsAuthority\Exceptions\AuthenticationException
     */
    public function handleFailure() {
        parent::handleFailure();
        
        if(! $this->isSuccessful()){
            if(\Illuminate\Support\Arr::get($this->jsonArray, 'responseDetail') == "Invalid PO"){
                throw new InvalidPoException();
            }
        }
    }
}