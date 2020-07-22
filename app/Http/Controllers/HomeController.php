<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use DateTime;
use App\Category;
use App\Medicine;
use App\Salesitem;
use App\Invoice;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        //Formatting date for performing query operationSS
        $todayDate = date("Y-m-d");
        $currentYear = date("Y");
        $currentMonth = date("m");

        //Date modify for back previous 7 days back
        $date = DateTime::createFromFormat('Y-m-d', $todayDate);
        $date->modify("-7 days");
        $week = $date->format('Y-m-d'); //date modified previous 7 days back


        //index page count statistics
        $no_of_medicine_categories = Category::count();
        $no_of_medicine_items = Medicine::count();
        $no_of_executives = User::where('user_type', "executive")->count();
        $no_of_invoices = Invoice::count();

        //index page statistic data return from here
        $today_sell_no_medicine_sell = Salesitem::where('created_at', 'Like', "%$todayDate%")->sum('medicine_quantity');
        $week_sell_no_medicine_sell = Salesitem::whereDate('created_at', '>=', $week)->whereDate('created_at', '<=', $todayDate)->sum('medicine_quantity');
        $year_sell_no_medicine_sell = Salesitem::where('created_at', 'Like', "%$currentYear%")->sum('medicine_quantity');
        $month_sell_no_medicine_sell = Salesitem::where('created_at', 'Like', "%$currentMonth%")->sum('medicine_quantity');

        $today_sell_amount = Invoice::where('created_at', 'Like', "%$todayDate%")->sum('grand_total');
        $week_sell_amount =  Invoice::whereDate('created_at', '>=', $week)->whereDate('created_at', '<=', $todayDate)->sum('grand_total');
        $month_sell_amount = Invoice::where('created_at', 'Like', "%$currentMonth%")->sum('grand_total');
        $year_sell_amount =  Invoice::where('created_at', 'Like', "%$currentYear%")->sum('grand_total');

        //dd($week_sell_amount);

        $data = array('no_of_medicine_categories' => $no_of_medicine_categories,
                      'no_of_medicine_items'      => $no_of_medicine_items,
                       'no_of_executives'         => $no_of_executives,
                        'no_of_invoices'          => $no_of_invoices,
                    'today_sell_no_medicine_sell' => $today_sell_no_medicine_sell,
                    'week_sell_no_medicine_sell'  => $week_sell_no_medicine_sell,
                  'month_sell_no_medicine_sell'   => $month_sell_no_medicine_sell,
                  'year_sell_no_medicine_sell'    => $year_sell_no_medicine_sell,
                        'today_sell_amount'       => $today_sell_amount,
                        'week_sell_amount'        => $week_sell_amount,
                     'month_sell_amount'          => $month_sell_amount,
                    'year_sell_amount'            => $year_sell_amount,
                    );


        return view('pages.index')->with('data', $data);

    }


}
