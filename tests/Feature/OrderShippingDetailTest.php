<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests\Feature;


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
}