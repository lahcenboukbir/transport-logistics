<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:download reports', ['only' => ['pdf', 'excel']]);
    }

    public function pdf()
    {
        return view('reports.pdf');
    }

    public function excel()
    {
        return view('reports.excel');
    }

    public function analytics()
    {
        $total_prospects = DB::table('prospects')->count();
        $new_prospects = DB::table('prospects')->where('status', 'new')->count();
        $interested_prospects = DB::table('prospects')->where('status', 'interested')->count();
        $not_interested_prospects = DB::table('prospects')->where('status', 'not interested')->count();
        $customer_prospects = DB::table('prospects')->where('status', 'customer')->count();

        // dd($total_prospects);
        return view('reports.analytics', compact(
            'total_prospects',
            'new_prospects',
            'interested_prospects',
            'not_interested_prospects',
            'customer_prospects'
        ));
    }
}
