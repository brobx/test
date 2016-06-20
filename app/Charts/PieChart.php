<?php


namespace App\Charts;


class PieChart extends Chart
{
    /**
     * Transforms a data object to a suitable data structure for the chart.
     *
     * @param null $data
     * @return array
     */
    public function getData($data = null)
    {
        $count = count($data);

        return [
            'labels' => array_keys($data),
            'datasets' => [
                [
                    'data' => array_values($data),
                    'backgroundColor' => $this->selectColors($count),
                    'hoverBackgroundColor' => $this->selectColors($count)
                ]
            ]
        ];
    }
}