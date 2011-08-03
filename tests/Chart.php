<?php
namespace tests\units\Charts;

//Inclusion de la classe à tester
require_once __DIR__.'/../ChartData.php';
require_once __DIR__.'/../Chart.php';

//Inclusion de Atoum dans toutes les classes de tests
require_once __DIR__ . '/atoum/mageekguy.atoum.phar';

use \mageekguy\atoum;


/**
 * Test de la classe Chart
 */
class Chart extends atoum\test
{
    public function testRenderer () {
        $chart = new \Charts\Chart();
        $chart->addData('test1',5, array ('test'=>'1'));
        $chart->addData('test2',5, array ('test'=>'1'));
        $this->assert->exception (function () use ($chart) {
                    $chart->render();
          })->isInstanceOf('\Exception');

    }
}
