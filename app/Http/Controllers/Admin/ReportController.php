<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Request;
use DB;
use App;

class ReportController extends Controller
{
    public function day()
    {
        $data = DB::table('sales')
            ->get();
        return view('report.day.index', compact('data'));
    }
    public function day_search()
    {
        $date1 = Request::get('date1');
        $date2 = Request::get('date2');
        $query = DB::table('sales')->whereBetween('date', [$date1, $date2])
            ->orderBy('sale_id', 'desc')
            ->get();
        $data['data']   =   $query;
        return view('report.day.index', $data);
    }

    public function day_p()
    {
        $date1 = Request::get('date1');
        $date2 = Request::get('date2');
        $query = DB::table('sales')

            ->whereBetween('date', [$date1, $date2])
            ->orderBy('sale_id', 'asc')
            ->get();

        $data['data']   =   $query;
        return view('report.day.print_data', $data);
    }

    public function day_pdf()
    {
        $date1 = Request::get('date1');
        $date2 = Request::get('date2');
        $query = DB::table('sales')

            ->whereBetween('date', [$date1, $date2])
            ->orderBy('sale_id', 'asc')
            ->get();

        $data['data']   =   $query;
        $view = view('report.day.print_data', $data)->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Report Day Sale.pdf');
    }

    public function month()
    {
        $data = DB::table('sales')
            ->get();
        return view('report.month.index', compact('data'));
    }

    public function month_search()
    {

        $query = DB::table('sales')->whereMonth('date', Request::get('bulan'))
            ->orderBy('sale_id', 'desc')
            ->get();

        $data['data']   =   $query;
        return view('report.month.index', $data);
    }

    public function month_p()
    {
        $query = DB::table('sales')
            ->whereMonth('date', Request::get('bulan'))
            ->orderBy('sale_id', 'asc')
            ->get();

        $data['data']   =   $query;
        return view('report.month.print_data', $data);
    }
    public function month_pdf()
    {

        $query = DB::table('sales')

            ->whereMonth('date', Request::get('bulan'))
            ->orderBy('sale_id', 'asc')
            ->get();

        $data['data']   =   $query;
        $view = view('report.month.print_data', $data)->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Report Month Sale.pdf');
    }

    public function year()
    {
        $data = DB::table('sales')
            ->get();
        return view('report.year.index', compact('data'));
    }
    public function year_search()
    {
        $query = DB::table('sales')->whereYear('date', Request::get('tahun'))
            ->orderBy('sale_id', 'desc')
            ->get();

        $data['data']   =   $query;
        return view('report.year.index', $data);
    }
    public function year_p()
    {
        $query = DB::table('sales')
            ->whereYear('date', Request::get('tahun'))
            ->orderBy('sale_id', 'asc')
            ->get();

        $data['data']   =   $query;
        return view('report.year.print_data', $data);
    }
    public function year_pdf()
    {

        $query = DB::table('sales')

            ->whereYear('date', Request::get('tahun'))
            ->orderBy('sale_id', 'asc')
            ->get();

        $data['data']   =   $query;
        $view = view('report.year.print_data', $data)->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Report Year Sale.pdf');
    }
}
