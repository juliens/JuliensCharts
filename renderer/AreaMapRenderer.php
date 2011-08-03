<?php

namespace Charts\Renderer;

class AreaMapRenderer implements IChartRenderer
{
    private $_name = null;

    public function __construct($pName)
    {
        $this->_name = $pName;
    }

    public function render($pDatas)
    {
        $html = '<MAP NAME="' . $this->_name . '">';
        foreach ($pDatas as $data) {
            $ar = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($data->polygons)), false);
            $polygone_str = implode(',', $ar);
            $href = isset ($data->params['href']) ? $data->params['href'] : '#';
            $html .= <<<EOT
                <AREA SHAPE="poly"
                 HREF="$href" title="{$data->label} ({$data->value})"
                    COORDS="$polygone_str">
EOT;
        }
        $html .= '</MAP>';
        return $html;
    }

    public function setPalette($pPalette)
    {
        // TODO: Implement setPalette() method.
    }
}
