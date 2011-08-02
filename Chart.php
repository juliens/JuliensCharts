<?php

namespace Charts;

class Chart
{

    /**
     * @var \Charts\Renderer\IChartRenderer
     */
    private $_renderer = null;

    /**
     * @throws \Exception
     * @param Charts\Renderer\IRenderer|null $renderer
     * @return mixed
     */
    public function render (\Charts\Renderer\IChartRenderer $renderer = null) {
        if ($renderer===null) {
            if ($this->_renderer==null) {
            throw new \Exception('Aucune moteur de rendu');
        }
            $renderer = $this->_renderer;
        }
        $this->_calculatePolygons();
        return $renderer->render($this->_datas);
    }



    private $_datas = array();

    private $_total = 0;

    private $_center = array('x'=>120, 'y'=>120);

    private $_rayon = 100;

    public function addData($label, $value, $params = array())
    {
        $this->_total += $value;
        $this->_datas[] = new ChartData($label,$value);
    }

    private function _calculatePolygons()
    {
        $start = 0;
        $angle = (pi() * 2) / $this->_total;
        $currentColor = 0;
        for ($poly = 0; $poly < count($this->_datas); $poly++) {
            $this->_datas[$poly]->polygons = array();
            $end = $start + ($this->_datas[$poly]->value * $angle);

            $this->_datas[$poly]->polygons = array ();
            $this->_datas[$poly]->polygons[] = $this->_center;;
            for ($i = $start; $i < $end; $i += 0.1) {
                $this->_datas[$poly]->polygons[] = array(
                                    'x' => $this->_rayon * cos($i) + $this->_center['x'],
                                    'y' => $this->_rayon * sin($i) + $this->_center['y']
                );
            }
            $this->_datas[$poly]->polygons[] = array('x' => $this->_rayon * cos($end) + $this->_center['x'], 'y' => $this->_rayon * sin($end) + $this->_center['y']);;
            $this->_datas[$poly]->polygons[] = $this->_center;;
            $this->_datas[$poly]->center =
                array('x' => ($this->_rayon*0.6) * cos($end-(($end-$start)/2)) + $this->_center['x'], 'y' => ($this->_rayon*0.6) * sin($end-(($end-$start)/2)) + $this->_center['y']);
            $start = $end;
        }
    }

    public function setRenderer (\Charts\Renderer\IChartRenderer $pRenderer) {
        $this->_renderer = $pRenderer;
    }

}