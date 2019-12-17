<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Responses;


use Mahmud\PartsAuthority\Exceptions\NoMatchingPartException;
use Mahmud\PartsAuthority\Utils\Arr;
use Mahmud\PartsAuthority\Utils\Stock;

class CheckStockResponse extends Response {
    /**
     * @return Stock|object
     * @throws \JsonMapper_Exception
     */
    public function getStock() {
        $mapper = new \JsonMapper();
        return $mapper->map(Arr::toObject($this->jsonArray['responseDetail']), new Stock());
    }
    
    /**
     * @throws NoMatchingPartException
     * @throws \Mahmud\PartsAuthority\Exceptions\AuthenticationException
     */
    public function handleFailure() {
        parent::handleFailure();
        
        if (!$this->isSuccessful()) {
            if (\Illuminate\Support\Arr::get($this->jsonArray, 'responseDetail.err_description') === 'No matching parts found') {
                throw new NoMatchingPartException();
            }
        }
    }
}