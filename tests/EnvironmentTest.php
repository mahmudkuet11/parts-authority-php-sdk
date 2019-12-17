<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests;


use Mahmud\PartsAuthority\PartsAuthority;
use Mahmud\PartsAuthority\PartsAuthoritySandbox;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase {
    /**
     * @test
     */
    public function it_returns_sandbox_instance_if_test_credential_is_provided() {
        $partsAuthority = PartsAuthority::make('11111', 'test_user', 'test_password');
        
        $this->assertInstanceOf(PartsAuthoritySandbox::class, $partsAuthority);
    }
    
    /**
     * @test
     */
    public function it_returns_production_instance_if_test_credential_is_not_provided() {
        $partsAuthority = PartsAuthority::make('11111', 'not_test_user', 'not_test_password');
        
        $this->assertInstanceOf(PartsAuthority::class, $partsAuthority);
    }
}