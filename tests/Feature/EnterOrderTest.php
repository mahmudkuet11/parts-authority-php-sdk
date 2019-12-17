<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests\Feature;


use Mahmud\PartsAuthority\Exceptions\AuthenticationException;
use Mahmud\PartsAuthority\PartsAuthoritySandbox;
use Mahmud\PartsAuthority\Requests\OrderHeader;
use Mahmud\PartsAuthority\Requests\OrderItem;
use Mahmud\PartsAuthority\Tests\TestCase;
use Mahmud\PartsAuthority\Utils\ShippingMethodsEnum;

class EnterOrderTest extends TestCase {
    /**
     * @test
     */
    public function it_throws_authentication_exception_if_invalid_credential_is_provided() {
        $partsAuthority = PartsAuthoritySandbox::make('invalid_account_no', 'invalid_username', 'invalid_pass');
        $this->expectException(AuthenticationException::class);
        $orderHeader = new OrderHeader("JOHN DOE", "123456789012", "123 ANY STREET", "APT 1A",
            "ANYWHERE", "ZZ", "12345", "US", ShippingMethodsEnum::FEDEX_HOME_DELIVERY);
        $orderItems = [
            new OrderItem("AA", "test_part", 1)
        ];
        $partsAuthority->enterOrder($orderHeader, $orderItems);
    }
    
    /**
     * @test
     */
    public function it_can_place_an_order() {
        $partsAuthority = $this->getPartsAuthorityInstance();
        $orderHeader = new OrderHeader("JOHN DOE", "123456789012", "123 ANY STREET", "APT 1A",
            "ANYWHERE", "ZZ", "12345", "US", "FDH");
        $orderItems = [
            new OrderItem("AA", "test_part", 1)
        ];
        $status = $partsAuthority->enterOrder($orderHeader, $orderItems);
        $this->assertTrue($status);
    }
}