<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Requests;


class OrderItem {
    /**
     * @var string
     */
    public $line_code;
    /**
     * @var string
     */
    public $part_num;
    /**
     * @var int
     */
    public $quantity;
    
    /**
     * OrderItem constructor.
     *
     * @param string $line_code
     * @param string $part_num
     * @param int    $quantity
     */
    public function __construct(string $line_code, string $part_num, int $quantity) {
        $this->line_code = $line_code;
        $this->part_num = $part_num;
        $this->quantity = $quantity;
    }
    
    public function toArray() {
        return [
            'line_code' => $this->line_code,
            'part_num'  => $this->part_num,
            'quantity'  => $this->quantity,
        ];
    }
}