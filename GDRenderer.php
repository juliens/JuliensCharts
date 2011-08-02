<?php

class GDRenderer implements Charts\Renderer\IChartRenderer
{
    public function render($pDatas)
    {
        $im = @imagecreatetruecolor(300, 300);
        imageantialias($im, true);
        imagefilledrectangle($im, 0, 0, 300, 300, imagecolorallocate($im, 255, 255, 255));


        //Affichage Camenbert
        foreach ($pDatas as $data) {
            if ($data->value == 0) {
                continue;
            }
            $color = imagecolorallocate($im, 255,0,0);
            $polygon = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($data->polygons)), false);
            imagefilledpolygon($im,$polygon, count($polygon)/2, $color);
            $black = imagecolorallocate($im,0,0,0);
            imagepolygon($im,$polygon, count($polygon)/2, $black);
            imagestring($im, '3', $data->center['x'],$data->center['y'], $data->value, $black);
        }
        ob_start();
        imagepng($im);
        $toReturn = ob_get_clean();
        imagedestroy($im);
        return $toReturn;

    }
}
