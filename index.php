<?php

require_once './Chart.php';
require_once './IRenderer.php';
require_once './ChartData.php';
require_once './ImagickRenderer.php';

class renderer implements Charts\Renderer\IChartRenderer
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

$chart = new Charts\Chart ();
$chart->addData('Test1', 10);
$chart->addData('Test2', 10);
//$chart->addData('Test3', 10);
$chart->addData('Test4', 20);
//$chart->addData('Test5', 10);

header("Content-Type: image/png");
echo $chart->render(new ImagickRenderer());

/*
$rendererik = new ImagickRenderer();
$renderergd = new GDRenderer();
$rendererareamap = new AreaMapRenderer('test');
$chart->setRenderer($renderergd);

//header("Content-Type: image/png");
echo htmlspecialchars($chart->render($rendererareamap));
*/

