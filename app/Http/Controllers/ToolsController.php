<?php

namespace App\Http\Controllers;

use App\Calculators\BankingCalculator;
use App\Charts\PieChart;
use App\Http\Requests;
use Illuminate\Http\Request;

class ToolsController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('tools.index');
    }

    /**
     * @return mixed
     */
    public function getBudget()
    {
        return view('tools.budget');
    }

    /**
     * @param Request $request
     * @param PieChart $chart
     * @return
     */
    public function postBudget(Request $request, PieChart $chart)
    {
        $recommendations = (new BankingCalculator(null, $request))->recommendations();

        return response()->json([
            'recommendations' => [
                'savings' => $recommendations['savings'] ? $this->transformRecommendations($recommendations['savings']) : trans('main.savingsNotEligible'),
                'borrowing' => $recommendations['borrowing'] ? $this->transformRecommendations($recommendations['borrowing']) : trans('main.borrowingNotEligible'),
            ],
            'chart' => $chart->getData($this->transformPieChart($request))
        ]);
    }

    /**
     * @param $recommendations
     * @return array
     */
    private function transformRecommendations($recommendations)
    {
        $transformed = [];

        foreach ($recommendations as $recommendation) {
            $transformed[] = [
                'name' => $recommendation->translate()->name,
                'url' => route('services.listings', ['listings' => $recommendation->id, trans('main.income') => request(trans('main.income'))]),
            ];
        }

        return $transformed;
    }

    /**
     * @param $request
     * @return array
     */
    private function transformPieChart($request)
    {
        $transformed = [];

        foreach ($request->get('expenses') + [trans('main.income') => $request->get(trans('main.income'))] as $key => $value) {
            if($value <= 0) {
               continue;
            }

            $transformed[$key] = $value;
        }

        return $transformed;
    }
}
