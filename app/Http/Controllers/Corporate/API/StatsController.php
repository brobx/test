<?php

namespace App\Http\Controllers\Corporate\API;

use App\Charts\BarChart;
use App\Charts\PieChart;
use App\Corporate;
use App\Http\Controllers\API\APIController;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class StatsController extends APIController
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    /**
     * @var Corporate
     */
    private $corporate;

    /**
     * StatsController constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->user = $guard->user();
        $this->corporate = $this->user->corporate;
        $this->stats = $this->corporate->stats();
    }

    /**
     * @param PieChart $chart
     * @return \Illuminate\Http\JsonResponse
     */
    public function types(PieChart $chart)
    {
        $data = $this->stats->countLeads();

        return $this->respond($chart->getData($data));
    }

    /**
     * @param Request $request
     * @param BarChart $chart
     * @return \Illuminate\Http\JsonResponse
     */
    public function leads(Request $request, BarChart $chart)
    {
        $period = $request->has('period') ? $request->get('period') : 'weekly';
        
        $chart->setLabels(array_keys($this->stats->getPeriodLabels($period)));
        
        $statData = $this->stats->{$period . 'Leads'}();

        if (in_array($period, ['weekly', 'monthly'])) {
            foreach ($statData as $label => $dataset) {
                $set = array_replace($this->stats->getPeriodLabels($period), $dataset);
                $chart->addDataset($set, $label);
            }
        }

        else {
            $data =  array_replace($this->stats->getPeriodLabels($period), $this->stats->{$period . 'Leads'}());
            $chart->addDataset($data, 'This ' . ucfirst(str_replace('ly', '', $period)));
        }

        return $this->respond($chart->getData());
    }
}
