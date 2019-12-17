<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Responses;


use Illuminate\Support\Arr;
use Mahmud\PartsAuthority\Exceptions\AuthenticationException;

class Response {
    protected $jsonArray;
    
    public function __construct($json) {
        $this->jsonArray = json_decode($json, true);
    }
    
    /**
     * @throws AuthenticationException
     */
    public function handleFailure() {
        $this->handleAuthentication();
    }
    
    /**
     * @throws AuthenticationException
     */
    public function handleAuthentication() {
        if (!$this->isSuccessful() && Arr::get($this->jsonArray, "responseDetail") === 'Authentication Failure') {
            throw new AuthenticationException();
        }
    }
    
    /**
     * @return bool
     */
    public function isSuccessful() {
        return Arr::get($this->jsonArray, "responseStatus") === 'Success';
    }
}