<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests;


use Mahmud\PartsAuthority\PartsAuthoritySandbox;

class TestCase extends \PHPUnit\Framework\TestCase {
    public function getPartsAuthorityInstance() {
        return PartsAuthoritySandbox::make('11111', 'test_user', 'test_password');
    }
}