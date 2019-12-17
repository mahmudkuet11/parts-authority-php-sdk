<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Mahmud\PartsAuthority\Exceptions\AuthenticationException;
use Mahmud\PartsAuthority\Responses\CheckStockResponse;
use Mahmud\PartsAuthority\Utils\Stock;

class PartsAuthority {
    private $accountNumber;
    private $username;
    private $password;
    
    protected function __construct($accountNumber, $username, $password) {
        $this->accountNumber = $accountNumber;
        $this->username = $username;
        $this->password = $password;
    }
    
    public static function make($accountNumber, $username, $password) {
        if ($accountNumber === '11111' && $username === 'test_user' && $password === 'test_password') {
            return new PartsAuthoritySandbox($accountNumber, $username, $password);
        }
        
        return new self($accountNumber, $username, $password);
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
        return "http://eorders.panetny.com";
    }
    
    protected function getRequestCredential() {
        return [
            "accountNum" => $this->accountNumber,
            "client"     => "ExampleClient V1",
            "userName"   => $this->username,
            "userPass"   => $this->password,
        ];
    }
}