<?php

namespace tests\units\Charts;

//Inclusion de la classe à tester
require_once __DIR__.'/../ChartData.php';

//Inclusion de Atoum dans toutes les classes de tests
require_once __DIR__.'/atoum/mageekguy.atoum.phar';

use \mageekguy\atoum;


/**
 * Test de la classe \BasicTypes
 */
class ChartData extends atoum\test
{
    public function testConstruct ()
    {
        $label = 'test1';
        $value= 10;
        $color = 'test';
        $options = array ();
        $chart = new \Charts\ChartData($label,$value,$color,$options);
        $this->assert
                ->string($chart->label)
                ->isEqualTo($label);
        
        $this->assert
                ->integer($chart->value)
                ->isEqualTo($value);
    }


}
