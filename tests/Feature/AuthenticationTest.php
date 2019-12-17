<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests\Feature;


use Mahmud\PartsAuthority\Exceptions\AuthenticationException;
use Mahmud\PartsAuthority\PartsAuthoritySandbox;
use Mahmud\PartsAuthority\Tests\TestCase;

class AuthenticationTest extends TestCase {
    /**
     * @test
     */
    public function it_throws_authentication_exception_if_wrong_credential_is_provided() {
        $partsAuthority = PartsAuthoritySandbox::make('invalid_account_no', 'invalid_username', 'invalid_pass');
        $this->expectException(AuthenticationException::class);
        $partsAuthority->getStock('AA', 'test_part');
    }
    
    /**
     * @test
     */
    public function it_does_not_throw_authentication_exception_if_valid_credential_is_provided() {
        $partsAuthority = $this->getPartsAuthorityInstance();
        $partsAuthority->getStock('AA', 'test_part');
        $this->assertTrue(true);
    }
}