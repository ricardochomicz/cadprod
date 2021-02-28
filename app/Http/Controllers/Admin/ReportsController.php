<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Charts\ReportsChart;
use App\Enum\Enum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function months(ReportsChart $chart, int $year = null)
    {
        $year = $year ?? date('Y') - 1;

        $chart->labels(Enum::months());
        $chart->dataset($year, 'bar', $this->getData($year))
            ->options([
                'backgroundColor' => 'rgba(75, 148, 191, 0.5)',
            ]);
        /*
        $chart->dataset('2019', 'bar', $this->getData(2019))
            ->options([
                'backgroundColor' => 'rgba(75, 148, 191, 0.3)',
            ]);
                */
        return view('admin.charts.chart', compact('chart'));
    }

    public function years(ReportsChart $chart, int $yearStart = null)
    {
        $year = $this->getDataYear();
        $color = '#' . dechex(rand(0x000000, 0xFFFFFF));
        $chart->labels($year['labels']);
        
            $chart->dataset('Relatório de Vendas', 'bar', $year['values'])
            ->options([
                'backgroundColor' => $color,
            ]);
        
        
        /*
        $chart->dataset('2019', 'bar', $this->getData(2019))
            ->options([
                'backgroundColor' => 'rgba(75, 148, 191, 0.3)',
            ]);
                */
        return view('admin.charts.chart', compact('chart'));
    }

    public function getData(int $year)
    {
        $data = Order::whereYear('date', $year)
            ->select(DB::raw('sum(total) as sums'))
            ->groupBy(DB::raw('MONTH(date)'))
            ->pluck('sums')
            ->toArray();

        return $data;
    }

    public function getDataYear()
    {
        $data = Order::select(DB::raw('sum(total) as total'), DB::raw('EXTRACT(YEAR from date) as year'))
            ->groupBy(DB::raw('YEAR(date)'))
            //->pluck('sums')
            ->get();
        return [
            'labels' => $data->pluck('year'),
            'values' => $data->pluck('total')
        ];
    }
}
