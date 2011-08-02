<?php
namespace Charts;

class ChartData {

    public function __construct ($pLabel, $pValue, $pColor = null, $pOptions = array ()) {
        $this->label = $pLabel;
        $this->value = $pValue;
        $this->color = $pColor;
        $this->options = $pOptions;
    }
    public $value = null;
    public $label = null;
    public $polygons = array ();
    public $color = null;
    public $options = array ();
}
