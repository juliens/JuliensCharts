<?php

namespace Charts\Renderer;

use \Imagick;
use\ImagickDraw;
use \ImagickPixel;

class ImagickRenderer implements IChartRenderer
{

    private $_palette = array ();

    private $_rgbPalette = array ();


    public function getImagickPaletteColor ($pColorIndex) {
        $str_color = 'rgb('.implode(',',$this->_rgbPalette[$pColorIndex%count($this->_rgbPalette)]).')';
        if (!isset ($this->_palette[$str_color])) {
            $this->_palette[$str_color] = new \ImagickPixel();
            $this->_palette[$str_color]->setcolor($str_color);
        }
        return $this->_palette[$str_color];
    }

    public function getPaletteColor ($pColorIndex) {
        if (count ($this->_palette)==0) {
            $this->_defaultPalette();
        }
        return $this->_palette[$pColorIndex%count($this->_palette)];
    }

    public function render($pDatas)
    {
        $im = new Imagick();
        $im->newImage(300, 300, "white", "png");

        $draw = new ImagickDraw();
        foreach ($pDatas as $key => $data)
        {
            if ($data->value == 0) {
                continue;
            }
            $draw->setFillColor($this->getImagickPaletteColor($data->getOption('colorindex')));
            $draw->setstrokecolor('black');
            $draw->polygon($data->polygons);

            $draw->setFillColor('black');
            $draw->setFontSize(18);
            $draw->annotation($data->center['x'], $data->center['y'] + 9, $data->value);

        }
        $im->drawimage($draw);

        return ''.$im;
    }

    public function setPalette ($pPalette) {
        $this->_rgbPalette = $pPalette;
    }

    private function _defaultPalette () {
        /*
        for ($h=0.9;$h>=0.3;$h-=0.07) {
            $color = new \ImagickPixel();
            $color->sethsl(0.7,$h,$h);
            $this->_palette[] = $color;
        }
        $this->_rgbPalette = $this->getPaletteRGB();
        */
    }

}
