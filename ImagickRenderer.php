<?php

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