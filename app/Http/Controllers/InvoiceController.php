<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Input;
use App\Medicine;
use App\Invoice;
use App\Salesitem;
use Auth;
use Cart;
use Session;

class InvoiceController extends Controller
{


    public function addtocart(Request $request)
    {
        $sellquantity = $request->sellQuantity; // quantity from add to list


        $medicine = Medicine::where('id', $request->medicine_id) //finding medicine which is added to list
        ->first();

        $items = Cart::content(); //all cart items
        $flag = 0; //flag zero means cart medicine quantity is less than quantity stocked in db
        foreach ($items as $item) {
            if ($item->name == $medicine->medicine_name) {
                $total_qty = $item->qty + $sellquantity; //total medicine which will be added in cart

                if ($total_qty > $medicine->quantity) // checking total medicine quantity of specif medicine in db is less than the medicine quantity will be added in cart
                {
                    Session::flash('message', 'medicine quantiy exceed!!!!');
                    $flag = 1;
                    break;
                }
            }
        }
        if ($flag == 0) {


            //add to list item is added to cart
            $cart_data = array();
            $cart_data['qty'] = $sellquantity;
            $cart_data['id'] = $medicine->id;
            $cart_data['name'] = $medicine->medicine_name;
            $cart_data['price'] = $medicine->selling_price;
            $cart_data['weight'] = 0;
            Cart::add($cart_data);
        }


        return redirect(route('pointofsale.index'));
    }

    public function saveInvoice(Request $request)
    {

        $vat = $request->vat;
        $discount = $request->discount;


        $items = Cart::content();

        $invoice_number = IdGenerator::generate(['table' => 'invoices', 'field' => 'invoice_number','reset_on_prefix_change' =>true,'length' => 6, 'prefix' => date('ym')]);


        //insert data into invoice table
        $invoice = new Invoice();
        $invoice->invoice_number = $invoice_number;
        $invoice->user_id = Auth::user()->id;
        $invoice->invoice_time = date("h:i:sa");
        $invoice->discount = $discount;
        $invoice->vat = $vat;
        $invoice->created_by = Auth::user()->user_name;
        $invoice->updated_by = NULL;


        //dd($items);
        foreach ($items as $item) {

            $cost_price = 0.0;
            $selling_price = 0.0;


            $medicine_name = $item->name; //invoice medicne name

            $medicine_quantity = $item->qty; //invoice medicine quantity


            $medicine = Medicine::where('medicine_name', '=', $medicine_name)->first();

            //medicine quantity after creating invoice
            $latest_medicine_quantity = $medicine->quantity - $medicine_quantity;

            Medicine::where('medicine_name', 'LIKE', $medicine_name) //update medicine quantity
            ->update(['quantity' => $latest_medicine_quantity]);


            //calculating profit
            $cost_price = $cost_price + ($medicine->purchase_price * $medicine_quantity);
            $selling_price = $selling_price + ($medicine->selling_price * $medicine_quantity);
            $profit_amount = $selling_price - $cost_price;

            //insert data into sales items table
            $salesitem = new Salesitem();
            $salesitem->invoice_number = $invoice_number;
            $salesitem->medicine_id = $item->id;
            $salesitem->medicine_quantity = $item->qty;
            $salesitem->medicine_price_rate = $item->price;
            $salesitem->profit_amount = $profit_amount;
            $salesitem->created_by = Auth::user()->user_name;
            $salesitem->updated_by = NULL;
            $salesitem->save();
        }

        //dd($i);

        // subtotal and grandtotal
        $time = now()->format("j M y, g:i a");

        $subtotal = Cart::subtotal(2, '.', '');
        $total_vat = ($subtotal * $vat) / 100;
        $grand_total = $subtotal + $total_vat - $discount;
        $invoice->subtotal = $subtotal;
        $invoice->grand_total = $grand_total;

        $invoice->save();

        Cart::destroy();

        return view('pages.point_of_sale.invoice', compact('items','time','invoice_number','subtotal', 'grand_total', 'vat', 'discount', 'total_vat'));
    }

    public function deleteInvoiceItem($rowId)
    {
        Cart::update($rowId, 0);
        return redirect(route('pointofsale.index'));
    }


    public function dateWiseInvoiceReport(Request $request)
    {
        //dd($request->starting_date);
        //  $s = Input::get('starting_date');
        //  $e= Input::get('ending_date');
        if(isset($request->starting_date))
        {
            $invoices = Invoice::whereDate('created_at', '>=', $request->starting_date)
                ->whereDate('created_at', '<=', $request->ending_date)
                ->paginate(5);
            return view('pages.report.invoice_list', compact('invoices'));

        }

 else{
     $starting_date =date("yy-m-d");
     $ending_date   =date("yy-m-d");

     $invoices = Invoice::whereDate('created_at', '>=', $starting_date)
            ->whereDate('created_at', '<=', $ending_date)
            ->paginate(5);
     return view('pages.report.invoice_list', compact('invoices'));
 }
}

    public function addNewInvoice()
    {
        //Cart::destroy();
        //return redirect(route('pointofsale.index'));
       // return view('pages.point_of_sale.index');
         dd("hey");
    }




}
