<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Responses;


use Mahmud\PartsAuthority\Exceptions\EnterOrderFailureException;

class EnterOrderResponse extends Response {
    /**
     * @throws EnterOrderFailureException
     * @throws \Mahmud\PartsAuthority\Exceptions\AuthenticationException
     */
    public function handleFailure() {
        parent::handleFailure();
        
        if (!$this->isSuccessful()) {
            throw new EnterOrderFailureException();
        }
    }
}