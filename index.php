<?php

require_once './Chart.php';
require_once './IRenderer.php';
require_once './ChartData.php';
require_once './renderer/ImagickRenderer.php';
require_once './renderer/GDRenderer.php';
require_once './renderer/LegendRenderer.php';

/*class renderer implements Charts\Renderer\IChartRenderer
{
    public function render($pDatas)
    {
        echo "<pre>";
        foreach ($pDatas as $data) {
            var_dump($data->polygons);
        }
        echo "</pre>";
    }
}
*/
$chart = new Charts\Chart ();
$chart->addData('Test1', 10);
$chart->addData('Test2', 10);
//$chart->addData('Test3', 10);
$chart->addData('Test4', 20);
//$chart->addData('Test5', 10);

$renderer = new ImagickRenderer();
$palette = array ();
        for ($h=0.9;$h>=0.3;$h-=0.07) {
            $color = new \ImagickPixel();
            $color->sethsl(0.3,$h,$h);
            $palette[] = $color;
        }
$renderer->setPalette($palette);

$renderergd = new GDRenderer();
$rendererlegend = new LegendRenderer();
$rendererlegend->setPalette($renderer->getPaletteRGB());


$render = $chart->render($rendererlegend);
echo $render;exit;





if (!headers_sent()) header("Content-Type: image/png");
echo $render;


/*
$rendererik = new ImagickRenderer();
$renderergd = new GDRenderer();
$rendererareamap = new AreaMapRenderer('test');
$chart->setRenderer($renderergd);

//header("Content-Type: image/png");
echo htmlspecialchars($chart->render($rendererareamap));
*/