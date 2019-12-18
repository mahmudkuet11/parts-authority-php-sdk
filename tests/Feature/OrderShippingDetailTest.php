<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests\Feature;


use Mahmud\PartsAuthority\Exceptions\AuthenticationException;
use Mahmud\PartsAuthority\Exceptions\InvalidPoException;
use Mahmud\PartsAuthority\PartsAuthoritySandbox;
use Mahmud\PartsAuthority\Responses\OrderShippingDetailResponse;
use Mahmud\PartsAuthority\Tests\TestCase;
use Mahmud\PartsAuthority\Utils\ShippingPackage;

class OrderShippingDetailTest extends TestCase {
    /**
     * @test
     */
    public function it_returns_order_shipping_details() {
        $pa = $this->getPartsAuthorityInstance();
        $orderShippingDetailResponse = $pa->getOrderShippingDetail("PC1-test-999999998");
        $this->assertInstanceOf(OrderShippingDetailResponse::class, $orderShippingDetailResponse);
    }
    
    /**
     * @test
     */
    public function it_returns_shipping_packages() {
        $pa = $this->getPartsAuthorityInstance();
        $orderShippingDetailResponse = $pa->getOrderShippingDetail("PC1-test-999999999");
        $packages = $orderShippingDetailResponse->getShippingPackages();
        $actual = collect($packages)->map(function (ShippingPackage $shippingPackage) {
            return [
                'carrier'         => $shippingPackage->carrier,
                'tracking_number' => $shippingPackage->tracking_number
            ];
        })->all();
        $this->assertEquals([
            ['carrier' => 'FedEx', 'tracking_number' => '74899992240822250759'],
        ], $actual);
    }
    
    /**
     * @test
     */
    public function it_throws_exception_if_po_number_is_invalid() {
        $pa = $this->getPartsAuthorityInstance();
        
        $this->expectException(InvalidPoException::class);
        
        $pa->getOrderShippingDetail("invalid_po");
    }
    
    /**
     * @test
     */
    public function it_throws_authentication_exception_if_invalid_credential_is_provided() {
        $partsAuthority = PartsAuthoritySandbox::make('invalid_account_no', 'invalid_username', 'invalid_pass');
        $this->expectException(AuthenticationException::class);
        
        $partsAuthority->getOrderShippingDetail("PC1-test-999999998");
    }
}