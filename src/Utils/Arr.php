<?php
/**
 * Created by MD. Mahmud Ur Rahman <mahmudkuet11@gmail.com>.
 */

namespace Mahmud\PartsAuthority\Utils;


class Arr {
    public static function toObject($arr) {
        return json_decode(json_encode($arr));
    }
}