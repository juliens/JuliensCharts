<?php

namespace tests\units\Charts;

//Inclusion de la classe à tester
require_once __DIR__.'/../ChartData.php';

//Inclusion de Atoum dans toutes les classes de tests
require_once __DIR__ . '/atoum/mageekguy.atoum.phar';

use \mageekguy\atoum;


/**
 * Test de la classe Chart
 */
class ChartData extends atoum\test
{
    public function testConstruct ()
    {
        $label = 'test1';
        $value= 10;
        $color = 'test';
        $optionValue = 'truc';
        $options = array ('value'=>$optionValue);
        $chart = new \Charts\ChartData($label,$value,$options);
        $this->assert
                ->string($chart->label)
                ->isEqualTo($label);
        
        $this->assert
                ->integer($chart->value)
                ->isEqualTo($value);
        $this->assert
                ->string($chart->getOption('value'))
                ->isEqualTo($optionValue);
        $this->assert
                ->variable($chart->getOption('null_value'))
                ->isNull();
        $this->assert
                ->string($chart->getOption('default_value', 'default'))
                ->isEqualTo('default');
    }


}
