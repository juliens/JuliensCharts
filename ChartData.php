<?php
namespace Charts;

class ChartData {

    public function __construct ($pLabel, $pValue, $pOptions = array ()) {
        $this->label = $pLabel;
        $this->value = $pValue;
        $this->options = $pOptions;
    }

    public function getOption ($pName, $pDefault = null) {
        return isset ($this->options[$pName]) ? $this->options[$pName] : $pDefault;
    }

    public function setOption ($pName, $pValue) {
        $this->options[$pName] = $pValue;
    }

    public $value = null;
    public $label = null;
    public $polygons = array ();
    public $options = array ();
}
