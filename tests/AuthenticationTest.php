<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests;


use Mahmud\PartsAuthority\Exceptions\AuthenticationException;
use Mahmud\PartsAuthority\PartsAuthoritySandbox;
use PHPUnit\Framework\TestCase;

class AuthenticationTest extends TestCase {
    /**
     * @test
     * @throws AuthenticationException
     */
    public function it_throws_authentication_exception_if_wrong_credential_is_provided() {
        $partsAuthority = PartsAuthoritySandbox::make('invalid_account_no', 'invalid_username', 'invalid_pass');
        $this->expectException(AuthenticationException::class);
        $partsAuthority->getStock('AA', 'test_part');
    }
    
    /**
     * @test
     * @throws AuthenticationException
     */
    public function it_does_not_throw_authentication_exception_if_valid_credential_is_provided() {
        $partsAuthority = PartsAuthoritySandbox::make('11111', 'test_user', 'test_password');
        $partsAuthority->getStock('AA', 'test_part');
        $this->assertTrue(true);
    }
}