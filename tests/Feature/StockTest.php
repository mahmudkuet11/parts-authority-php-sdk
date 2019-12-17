<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Tests\Feature;


use Mahmud\PartsAuthority\Exceptions\NoMatchingPartException;
use Mahmud\PartsAuthority\Tests\TestCase;
use Mahmud\PartsAuthority\Utils\Stock;

class StockTest extends TestCase {
    /**
     * @test
     */
    public function it_returns_stock_instance() {
        $pa = $this->getPartsAuthorityInstance();
        $stock = $pa->getStock('AA', 'test_part');
        $this->assertInstanceOf(Stock::class, $stock);
    }
    
    /**
     * @test
     */
    public function it_returns_available_stock_for_a_part() {
        $pa = $this->getPartsAuthorityInstance();
        $stock = $pa->getStock('AA', 'test_part');
        $this->assertEquals([
            'instock' => 832,
            'price'   => 40.0,
            'core'    => 10.0,
            'sfran'   => 'AA',
            'spart'   => 'test_part',
        ], [
            'instock' => $stock->instock,
            'price'   => $stock->price,
            'core'    => $stock->core,
            'sfran'   => $stock->sfran,
            'spart'   => $stock->spart,
        ]);
    }
    
    /**
     * @test
     */
    public function it_throws_exception_if_no_matching_part_found() {
        $pa = $this->getPartsAuthorityInstance();
        $this->expectException(NoMatchingPartException::class);
        $pa->getStock('AA', '11112222');
    }
}