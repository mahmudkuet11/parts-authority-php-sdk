<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests\Feature;


use Mahmud\PartsAuthority\Exceptions\AuthenticationException;
use Mahmud\PartsAuthority\Exceptions\InvalidPoException;
use Mahmud\PartsAuthority\PartsAuthoritySandbox;
use Mahmud\PartsAuthority\Tests\TestCase;

class GetOrderInformationTest extends TestCase {
    /**
     * @test
     */
    public function it_returns_order_information() {
        $pa = $this->getPartsAuthorityInstance();
        
        $orderInfo = $pa->getOrderInformation("PC1-test-999999998");
        
        $this->assertEquals(["CustPoNum" =>  "PC1-test-999999998"], ["CustPoNum" => $orderInfo->CustPoNum]);
    }
    
    /**
     * @test
     */
    public function it_throws_exception_if_po_number_is_invalid() {
        $pa = $this->getPartsAuthorityInstance();
    
        $this->expectException(InvalidPoException::class);
        
        $pa->getOrderInformation("invalid_po");
    }
    
    /**
     * @test
     */
    public function it_throws_authentication_exception_if_invalid_credential_is_provided() {
        $partsAuthority = PartsAuthoritySandbox::make('invalid_account_no', 'invalid_username', 'invalid_pass');
        $this->expectException(AuthenticationException::class);
    
        $partsAuthority->getOrderInformation("PC1-test-999999998");
    }
}