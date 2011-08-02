<?php

require_once './Chart.php';
require_once './IRenderer.php';

class ChartData
{
    public $value = null;
    public $label = null;
    public $polygons = array();
    public $color = null;
}


class renderer implements Charts\Renderer\IChartRenderer
{
    public function render($pDatas)
    {
        foreach ($pDatas as $data) {
            var_dump($data->polygons);
        }
    }
}

class ImagickRenderer implements Charts\Renderer\IChartRenderer
{
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
            $draw->setFillColor('red');
            $draw->setstrokecolor('black');
            $draw->polygon($data->polygons);

            $draw->setFillColor('black');
            $draw->setFontSize(18);
            $draw->annotation($data->center['x'], $data->center['y'] + 9, $data->value);

        }
        $im->drawimage($draw);

        return $im;
    }
}


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


class AreaMapRenderer implements Charts\Renderer\IChartRenderer {
    private $_name = null;
    public function __construct($pName) {
        $this->_name = $pName;
    }
    public function render($pDatas) {
        $html = '<MAP NAME="' .$this->_name . '">';
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
}
$chart = new Charts\Chart ();
$chart->addData('Test1', 10);
$chart->addData('Test2', 10);
$chart->addData('Test3', 10);
$chart->addData('Test4', 10);
$chart->addData('Test5', 10);

$rendererik = new ImagickRenderer();
$renderergd = new GDRenderer();
$rendererareamap = new AreaMapRenderer('test');
$chart->setRenderer($renderergd);

//header("Content-Type: image/png");
echo htmlspecialchars($chart->render($rendererareamap));


/*
public function getAreaMap($pName)
    {
        $this->_calculatePolygone();
        $html = '<MAP NAME="' . $pName . '">';
        foreach ($this->_datas as $data) {
            $ar = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($data['polygon'])), false);
            $polygone_str = implode(',', $ar);
            $href = isset ($data['params']['href']) ? $data['params']['href'] : '#';
            $html .= <<<EOT
                <AREA SHAPE="poly"
                 HREF="$href" title="{$data['label']} ({$data['value']})"
                    COORDS="$polygone_str">
EOT;


        }
        $html .= '</MAP>';
        return $html;
    }
*/