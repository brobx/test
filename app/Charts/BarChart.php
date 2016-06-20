<?php

namespace App\Charts;

class BarChart extends Chart
{

    /**
     * Gets a suitable array with the chart data. formatted like the chart.js documentation.
     *
     * @param null $data
     * @return array
     */
    public function getData($data = null)
    {
        return [
            'labels' => $this->labels,
            'datasets' => $this->datasets
        ];
    }
}