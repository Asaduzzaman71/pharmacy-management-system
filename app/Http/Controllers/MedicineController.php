<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Medicine;
use App\Setting;
use Auth;
use DataTables;
use DateTime;
use DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {
            // $data = Medicine::latest()->get();
            //dd($data);
            $data = Medicine::with('category')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button"  name="details" id="' . $data->id . '" class="details btn btn-info btn-sm" type="submit" >Details</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href="' . route('medicine.edit', base64_encode($data->id)) . '"> <button class="edit btn btn-primary btn-sm" type="submit" >Edit</button></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.manage_medicine.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.manage_medicine.add_medicine')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todayDate = date("Y-m-d");

        // Validation
        $request->validate(
            [
                'medicine_name' => 'required|max:255|unique:medicines',
                'medicine_code' => 'required',
                'medicine_category_id' => 'required',
                'purchase_price' => 'required',
                'selling_price' => 'required',
                'expire_date' => 'required',
                'quantity' => 'required',
                'company_name' => 'required',
                'generic_name' => 'required',

            ],
            [
                'medicine_name.required' => 'Medicine Name required',
                'medicine_code.required' => 'Medicine Code required',
                'medicine_category_id.required' => 'Category Selection required',
                'purchase_price.required' => 'Purchase Price required',
                'selling_price.required' => 'Selling Price required',
                'expire_date.required' => 'Expire Date required',
                'quantity.required' => 'Quantity required',
                'company_name.required' => 'Company Name required',
                'generic_name.required' => 'Generic Name required',
            ]
        );


        // Storing database

        $Medicine = new Medicine();
        $Medicine->medicine_name = strtoupper($request->medicine_name);
        $Medicine->medicine_code = $request->medicine_code;
        $Medicine->medicine_category_id = $request->medicine_category_id;
        $Medicine->purchase_price = $request->purchase_price;
        $Medicine->selling_price = $request->selling_price;
        $Medicine->storing_area = $request->storing_area;
        $Medicine->quantity = $request->quantity;
        $Medicine->generic_name = $request->generic_name;
        $Medicine->medicine_class = $request->medicine_class;
        $Medicine->effects = $request->effects;
        $Medicine->expire_date = $request->expire_date;
        $Medicine->company_name = $request->company_name;
        $Medicine->adding_date = $todayDate;
        $Medicine->created_by = Auth::user()->user_name;
        $Medicine->status = '1';


        if ($Medicine->save()) {
            $request->session()->flash('message', 'Medicine has been successfully added');
            return redirect()->route('medicine.index');
        } else {
            return redirect()->route('medicine.create')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $uid = base64_decode($id);
        $medicine = Medicine::findOrFail($uid);
        $category = Category::findOrFail($medicine['medicine_category_id']);
        return view('pages.manage_medicine.edit', compact('medicine', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Validation

        $request->validate(
            [
                'medicine_name' => 'required',
                'medicine_code' => 'required',
                'medicine_category_id' => 'required',
                'purchase_price' => 'required',
                'selling_price' => 'required',
                'expire_date' => 'required',
                'quantity' => 'required',
                'company_name' => 'required',
                'generic_name'=>'required',

            ],
            [
                'medicine_name.required' => 'Medicine Name required',
                'medicine_code.required' => 'Medicine Code required',
                'medicine_category_id.required' => 'Category Selection required',
                'purchase_price.required' => 'Purchase Price required',
                'selling_price.required' => 'Selling Price required',
                'edate.required' => 'Expire Date required',
                'quantity.required' => 'Quantity required',
                'company_name.required' => 'Company Name required',
            ]
        );

        $Medicine = Medicine::find($id);
        $Medicine->medicine_name = strtoupper($request->medicine_name);
        $Medicine->medicine_code = $request->medicine_code;
        $Medicine->medicine_category_id = $request->medicine_category_id;
        $Medicine->purchase_price = $request->purchase_price;
        $Medicine->selling_price = $request->selling_price;
        $Medicine->storing_area = $request->storing_area;
        $Medicine->quantity = $request->quantity;
        $Medicine->generic_name = $request->generic_name;
        $Medicine->medicine_class = $request->medicine_class;
        $Medicine->effects = $request->effects;
        $Medicine->expire_date = $request->expire_date;
        $Medicine->company_name = $request->company_name;
        $Medicine->save();

        $request->session()->flash('message', 'Medicine Upadated');
        return redirect(route('medicine.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $data = Medicine::find($request->user_id);
        $data->delete();
    }

    /*
    Shortage Medicine display a listing of the resource.

    */

    public function shortage(Request $request)
    {

        $setting = Setting::find(1);

        if ($request->ajax()) {
            $data = Medicine::where('quantity', '<=', $setting->settings_quantity)
                ->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {

                    $button = '<button type="button"  name="details" id="' . $data->id . '" class="details btn btn-info btn-sm" type="submit" >Details</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href="' . route('medicine.quantity.form', base64_encode($data->id)) . '"> <button class="edit btn btn-info btn-sm" type="submit" >Add Quantity</button></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.manage_medicine.shortage');
    }

    public function medicineUpdateForm($id){
        $mid = base64_decode($id);
        $medicine = Medicine::findOrFail($mid);
        return view ('pages.manage_medicine.update_medicine_quantity',compact('medicine'));
    }



     public function updateMedicineQuantity(Request $request, $id)
    {

        // Validation

        $request->validate(
            [
               
                'purchase_price'=>'required',
                'selling_price'=>'required',
                'expire_date' => 'required',
                'quantity' => 'required',
               

            ],
            [
                
                'purchase_price.required' => 'Purchase Price required',
                'selling_price.required' => 'Selling Price required',
                'expire_date.required' => 'Expire Date required',
                'quantity.required' => 'Quantity required',
                
            ]
        );

       
        $medicine = Medicine::find($id);
        $medicine->purchase_price = $request->purchase_price;
        $medicine->selling_price = $request->selling_price;
        $medicine->quantity = $request->quantity;
        $medicine->expire_date = $request->expire_date;
        $medicine->save();
  
        


      $request->session()->flash('message', 'Medicine Quantity Upadated');

        return redirect(route('medicine.index'));
    }


    public function details(Request $request, $id)
    {

        //$uid = base64_decode($id);
        $medicine = Medicine::findOrFail($id);
        $category = Category::findOrFail($medicine['medicine_category_id']);
        //return view('pages.manage_medicine.details', compact('medicine', 'category'));
        return response()->json([
            'medicine' => $medicine,
            'category' => $category
        ]);
    }



    public function expired(Request $request)
    {

        $todayDate = date("Y-m-d");
        if ($request->ajax()) {
            $data = Medicine::where('expire_date', '<', $todayDate)
                ->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {

                    $button = '<button type="button"  name="details" id="' . $data->id . '" class="details btn btn-info btn-sm" type="submit" >Details</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.manage_medicine.expired');
    }

    public function nearExpired(Request $request)
    {

        //find remainder date from date base

        $setting = Setting::find(1);
        $settingDate = "+" . $setting->setting_day . " " . "days";

        //Date modify for find near expired find

        $todayDate = date("Y-m-d");
        $date = DateTime::createFromFormat('Y-m-d', $todayDate);
        $date->modify($settingDate);
        $nearExpired = $date->format('Y-m-d');


        if ($request->ajax()) {

            $data = Medicine::where('expire_date', '<=', $nearExpired)
                ->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {

                    $button = '<button type="button"  name="details" id="' . $data->id . '" class="details btn btn-info btn-sm" type="submit" >Details</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.manage_medicine.nearexpired');
    }


    public function searchByGenericOrClassName()
    {
        return view('pages.search_medicine.search_medicine_by_class_or_generic_name');
    }
}
