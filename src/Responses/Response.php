<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Responses;


use Mahmud\PartsAuthority\Exceptions\AuthenticationException;

class Response {
    protected $jsonArray;
    
    public function __construct($json) {
        $this->jsonArray = json_decode($json, true);
    }
    
    /**
     * @return bool
     */
    public function isSuccessful() {
        return $this->jsonArray['responseStatus'] === 'Success';
    }
    
    /**
     * @throws AuthenticationException
     */
    public function handleAuthentication() {
        if (! $this->isSuccessful() && $this->jsonArray['responseDetail'] === 'Authentication Failure') {
            throw new AuthenticationException();
        }
    }
    
    /**
     * @throws AuthenticationException
     */
    public function handleFailure() {
        $this->handleAuthentication();
    }
}