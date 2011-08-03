<?php
namespace tests\units\Charts\Renderer;

//Inclusion de la classe à tester
require_once __DIR__.'/../ChartData.php';
require_once __DIR__.'/../Chart.php';
require_once __DIR__.'/../renderer/IRenderer.php';
require_once __DIR__.'/../renderer/ImagickRenderer.php';

//Inclusion de Atoum dans toutes les classes de tests
require_once __DIR__ . '/atoum/mageekguy.atoum.phar';

use \mageekguy\atoum;


/**
 * Test de la classe ImagickRenderer
 */
class ImagickRenderer extends atoum\test
{
    public function testRenderer () {
        $chart = new \Charts\Chart();
        $chart->addData('test1',5);
        $chart->addData('test2',5);
        $ImagickRenderer = new \Charts\Renderer\ImagickRenderer();

        $this->assert->string($chart->render($ImagickRenderer))->isNotNull();


    }
}
