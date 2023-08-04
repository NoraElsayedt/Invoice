<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoices;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $notpaid=Invoices::where('value_status',2)->count()/\App\Models\Invoices::count()*100;
        $paid=Invoices::where('value_status',1)->count()/\App\Models\Invoices::count()*100;
        $part=Invoices::where('value_status',3)->count()/\App\Models\Invoices::count()*100;

        $chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 220])
         ->labels(['invoices not paid', 'invoices paid','invoices partailly paid'])
         ->datasets([
             [
                 "label" => "invoices not paid",
                 'backgroundColor' => ['#ec5858'],
                 'data' => [$notpaid]
             ],
             [
                 "label" => "invoices paid",
                 'backgroundColor' => ['#81b214'],
                 'data' => [$paid]
             ],
             [
                 "label" => "invoices  partailly paid",
                 'backgroundColor' => ['#ff9642'],
                 'data' => [$part]
             ],


         ])
         ->options([]);


         $chartjs2 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['invoices not paid', 'invoices paid','invoices partailly paid'])
        ->datasets([
            [
                'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
                'data' => [$notpaid, $paid,$part]
            ]
        ])
        ->options([]);


        return view('dashboard',compact('chartjs','chartjs2'));
    }
}
