<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Salesitem;
use App\Invoice;
use Session;

use Illuminate\Http\Request;

class SalesItemsController extends Controller
{
    public function index()
    {
        $salesitems = Salesitem::with('medicine')->orderBy('invoice_number', 'asc')->paginate(5);
        return view('pages.report.sales_item_list', compact('salesitems'));
    }


    public function dateWiseInvoiceIndex()
    {

        return view('pages.report.date_wise_invoice_index');
    }

    public function invoiceDetails($id)
    {

        $items    = Salesitem::with('medicine')->where('invoice_number', $id)->get();

        $invoice  = Invoice::where('invoice_number', $id)->first();

        return view('pages.report.invoice_details', compact('items', 'invoice'));
    }


    public function topSellingProduct(Request $request)
    {
        $items =Salesitem::groupBy('medicine_id')
        ->selectRaw('sum(medicine_quantity) as medicine_quantity_sum,salesitems.*,medicines.medicine_name,medicines.generic_name,medicines.company_name,medicines.selling_price')->orderBy('medicine_quantity_sum', 'desc')
        ->leftJoin('medicines', 'salesitems.medicine_id', 'medicines.id')
        ->get();
        return view('pages.report.top_selling_product',compact('items'));
    }
}
