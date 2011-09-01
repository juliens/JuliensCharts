<?php
/**
 * Created by JetBrains PhpStorm.
 * User: juliens
 * Date: 02/08/11
 * Time: 10:31
 * To change this template use File | Settings | File Templates.
 */

namespace charts\utils;

class utils {
    public static function imagickcolortorgbhex (\ImagickPixel $color) {
        preg_match('#rgb\(([0-9\.]*?)%,([0-9\.]*?)%,([0-9\.]*?)%\)#', $color->getcolorasstring(), $matches);
        list (,$r,$g,$b) = $matches;
        return dechex(255*$r/100).dechex(255*$g/100). dechex(255*$b/100);
    }
}
