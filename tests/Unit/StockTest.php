<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests\Unit;


use Mahmud\PartsAuthority\Tests\TestCase;
use Mahmud\PartsAuthority\Utils\Stock;

class StockTest extends TestCase {
    /**
     * @test
     */
    public function it_returns_total_price() {
        $stock = new Stock();
        $stock->price = 50.0;
        $stock->core = 10.0;
    
        $this->assertEquals(60.0, $stock->getTotalPrice());
        
        $stock = new Stock();
        $stock->price = 25.5;
        $stock->core = null;
        
        $this->assertEquals(25.5, $stock->getTotalPrice());
    }
    
    /**
     * @test
     */
    public function it_returns_true_if_stock_is_available() {
        $stock = new Stock();
        $stock->instock = 10;
        
        $this->assertTrue($stock->isAvailable());
    
        $stock = new Stock();
        $stock->instock = 0;
    
        $this->assertFalse($stock->isAvailable());
    }
}