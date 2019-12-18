<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority;


class PartsAuthoritySandbox extends PartsAuthority {
    public static function make($accountNumber, $username, $password, $baseUrl = "http://localhost:8000") {
        return new self($accountNumber, $username, $password, $baseUrl);
    }
    
    public function getStatus() {
        return 'test';
    }
}