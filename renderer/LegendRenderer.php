<?php

namespace Charts\Renderer;

class LegendRenderer implements IChartRenderer
{

    private $_palette = array();

    public function render($pDatas)
    {
        $html = '<ul  class="legend">';
        foreach ($pDatas as $data) {
            $html .= '<li style="background-color: #' . $this->getPaletteHexColor($data->getOption('colorindex')) . '"><a href="' . $data->getOption('href', '#') . '">' . $data->label . ' : ' . $data->value . '</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function setPalette($pPalette)
    {
        $this->_palette = $pPalette;
    }

    public function getPaletteColor($pColorIndex)
    {
        return $this->_palette[$pColorIndex % count($this->_palette)];
    }

    public function getPaletteHexColor($pColorIndex) {
        $color = $this->getPaletteColor($pColorIndex);
        $str_color = '';
        foreach ($color as $comp) {
            $str_color .= str_pad(dechex($comp),2,'0',STR_PAD_LEFT);
        }
        return $str_color;
    }
}
