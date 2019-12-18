<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Mahmud\PartsAuthority\Exceptions\AuthenticationException;
use Mahmud\PartsAuthority\Requests\OrderHeader;
use Mahmud\PartsAuthority\Requests\OrderItem;
use Mahmud\PartsAuthority\Responses\CheckStockResponse;
use Mahmud\PartsAuthority\Responses\EnterOrderResponse;
use Mahmud\PartsAuthority\Responses\GetOrderInformationResponse;
use Mahmud\PartsAuthority\Responses\OrderShippingDetailResponse;
use Mahmud\PartsAuthority\Utils\Stock;

class PartsAuthority {
    private $accountNumber;
    private $username;
    private $password;
    
    protected $baseUrl;
    
    protected function __construct($accountNumber, $username, $password, $baseUrl) {
        $this->accountNumber = $accountNumber;
        $this->username = $username;
        $this->password = $password;
        
        $this->baseUrl = $baseUrl;
    }
    
    public static function make($accountNumber, $username, $password, $baseUrl = "http://eorders.panetny.com") {
        if ($accountNumber === '11111' && $username === 'test_user' && $password === 'test_password') {
            return PartsAuthoritySandbox::make($accountNumber, $username, $password);
        }
        
        return new self($accountNumber, $username, $password, $baseUrl);
    }
    
    /**
     * @param $lineCode
     * @param $partNumber
     *
     * @return Stock
     * @throws AuthenticationException
     * @throws \JsonMapper_Exception
     * @throws Exceptions\NoMatchingPartException
     */
    public function getStock($lineCode, $partNumber) {
        $response = $this->getClient()->request('GET', 'api/orderEntry.psp', [
            'query' => [
                'reqData' => json_encode($this->getRequestCredential() + [
                        "line_code"   => $lineCode,
                        "part_number" => $partNumber,
                        "action"      => "checkStock"
                    ])
            ]
        ]);
        
        $checkStockResponse = new CheckStockResponse($response->getBody()->getContents());
        $checkStockResponse->handleFailure();
        
        return $checkStockResponse->getStock();
    }
    
    protected function getClient() {
        return new Client([
            'base_uri' => Str::finish($this->getBaseUrl(), '/')
        ]);
    }
    
    public function getBaseUrl() {
        return $this->baseUrl;
    }
    
    protected function getRequestCredential() {
        return [
            "accountNum" => $this->accountNumber,
            "client"     => "ExampleClient V1",
            "userName"   => $this->username,
            "userPass"   => $this->password,
        ];
    }
    
    /**
     * @param $poNumber
     *
     * @return mixed
     * @throws AuthenticationException
     * @throws Exceptions\InvalidPoException
     * @throws \JsonMapper_Exception
     */
    public function getOrderInformation($poNumber) {
        $response = $this->getClient()->request('GET', 'api/checkOrderStatus.psp', [
            'query' => [
                'reqData' => json_encode($this->getRequestCredential() + [
                        "action"   => "getOrderInformation",
                        "PoNumber" => $poNumber
                    ])
            ]
        ]);
        
        $getOrderInformationResponse = new GetOrderInformationResponse($response->getBody()->getContents());
        $getOrderInformationResponse->handleFailure();
        
        return Arr::first($getOrderInformationResponse->getOrderInformation());
    }
    
    /**
     * @param OrderHeader $orderHeader
     * @param OrderItem[] $orderItems
     *
     * @return bool
     * @throws AuthenticationException
     * @throws Exceptions\EnterOrderFailureException
     */
    public function enterOrder(OrderHeader $orderHeader, array $orderItems) {
        $orderItems = collect($orderItems)->map(function (OrderItem $orderItem) {
            return $orderItem->toArray();
        });
        $response = $this->getClient()->request('GET', 'api/orderEntry.psp', [
            'query' => [
                'reqData' => json_encode($this->getRequestCredential() + [
                        "action"      => "enterOrder",
                        "orderHeader" => $orderHeader->toArray() + ['status' => $this->getStatus()],
                        "orderItems"  => $orderItems
                    ])
            ]
        ]);
        
        $enterOrderResponse = new EnterOrderResponse($response->getBody()->getContents());
        $enterOrderResponse->handleFailure();
        
        return true;
    }
    
    public function getStatus() {
        return 'live';
    }
    
    /**
     * @param $poNumber
     *
     * @return OrderShippingDetailResponse
     * @throws AuthenticationException
     */
    public function getOrderShippingDetail($poNumber) {
        $response = $this->getClient()->request('GET', 'api/checkOrderStatus.psp', [
            'query' => [
                'reqData' => json_encode($this->getRequestCredential() + [
                        "action"   => "getOrderShippingDetail",
                        "PoNumber" => $poNumber
                    ])
            ]
        ]);
        $orderShippingDetailResponse = new OrderShippingDetailResponse($response->getBody()->getContents());
        $orderShippingDetailResponse->handleFailure();
        
        return $orderShippingDetailResponse;
    }
}