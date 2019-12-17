<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority;


class PartsAuthoritySandbox extends PartsAuthority {
    public static function make($accountNumber, $username, $password) {
        return new self($accountNumber, $username, $password);
    }
    
    public function getBaseUrl() {
        return "http://localhost:8000";
    }
}