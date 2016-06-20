<?php

namespace App\Charts;

abstract class Chart
{
    /**
     * @var array
     */
    protected $colors = [
        '#f56954',
        '#00a65a',
        '#f39c12',
        '#00c0ef',
        '#3c8dbc',
        '#d2d6de',
        '#3366CC',
        '#DC3912',
        '#FF9900',
        '#109618',
        '#990099',
        '#3B3EAC',
        '#0099C6',
        '#DD4477',
        '#66AA00',
        '#B82E2E',
        '#316395',
        '#994499',
        '#22AA99',
        '#AAAA11',
        '#6633CC',
        '#E67300',
        '#8B0707',
        '#329262',
        '#5574A6',
        '#3B3EAC'
    ];
    /**
     * @var int
     */
    protected $colorIndex = 0;

    /**
     * @var array
     */
    protected $datasets = [];

    /**
     * @var array
     */
    protected $labels = [];

    /**
     * @param $count
     * @return array
     */
    public function selectColors($count)
    {
        if($count == 1) {
            return $this->colors[0];
        }

        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $colors[] = $this->colors[$i];
        }

        return $colors;
    }

    /**
     * @param $labels
     * @return $this
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * @param $data
     * @param $label
     * @return $this
     */
    public function addDataset($data, $label)
    {
        $this->datasets[] = [
            'label' => $label,
            'backgroundColor' => $this->colors[$this->colorIndex],
            'borderColor' => $this->colors[$this->colorIndex],
            'borderWidth' => 1,
            'hoverBackgroundColor' => $this->colors[$this->colorIndex],
            'hoverBorderColor' => $this->colors[$this->colorIndex],
            'data' => array_values($data)
        ];

        $this->colorIndex++;

        return $this;
    }

    /**
     * Gets a suitable array with the chart data. formatted like the chart.js documentation.
     * It can work on a given data directly.
     *
     * @param null $data
     * @return array
     */
    public abstract function getData($data = null);
}