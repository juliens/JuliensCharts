<?php

namespace Charts\Renderer;

class GDRenderer implements IChartRenderer
{
    private $_palette = array();


    public function getPaletteColor($pColorIndex)
    {
        if (count($this->_palette) == 0) {
            $this->_defaultPalette();
        }
        return $this->_palette[$pColorIndex % count($this->_palette)];
    }

    public function setPalette($pPalette)
    {
        $this->_palette = $pPalette;
    }

    private function _defaultPalette()
    {
        for ($i=0;$i<15;$i++) {
            $this->_palette[] = array (rand(0,254),rand(0,254),rand(0,254));
        }
    }

    public function render($pDatas)
    {
        $im = @imagecreatetruecolor(300, 220);
        imageantialias($im, true);
        imagefilledrectangle($im, 0, 0, 300, 300, imagecolorallocate($im, 255, 255, 255));

        $gd_palette = array ();
        $this->_defaultPalette();
        foreach ($this->_palette as $color) {
            $gd_palette[] = imagecolorallocate($im, $color[0], $color[1], $color[2]);
        }
        //Affichage Camenbert
        foreach ($pDatas as $data) {
            if ($data->value == 0) {
                continue;
            }
            $polygon = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($data->polygons)), false);
            imagefilledpolygon($im, $polygon, count($polygon) / 2, $gd_palette[$data->getOption('colorindex')]);
            $black = imagecolorallocate($im, 255, 255, 255);
            imagepolygon($im, $polygon, count($polygon) / 2, $black);
            imagestring($im, '3', $data->center['x'], $data->center['y'], $data->value, $black);
        }
        ob_start();
        imagepng($im);
        $toReturn = ob_get_clean();
        imagedestroy($im);
        return $toReturn;

    }


}
