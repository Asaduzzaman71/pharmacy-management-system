<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Auth;
use DataTables;
use DateTime;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $data = Supplier::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button"  name="details" id="' . $data->id . '" class="details btn btn-info btn-sm" type="submit" >Details</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href="' . route('supplier.edit', base64_encode($data->id)) . '"> <button class="edit btn btn-primary btn-sm" type="submit" >Edit</button></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.manage_supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.manage_supplier.create');
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
                'supplier_name' => 'required',
                'supplier_phone' => 'required',
                'supplier_address' => 'required',
                'supplier_type' => 'required',
            ],
            [
                'supplier_name.required' => 'Name required',
                'supplier_phone.required' => 'Phone Number required',
                'supplier_address.required' => 'Address required',
                'supplier_type.required' => 'Supplier Type  required',
            ]
        );


        // Storing database

        $supplier = new Supplier();
        $supplier->supplier_name = $request->supplier_name;
        $supplier->supplier_type = $request->supplier_type;
        $supplier->supplier_phone = $request->supplier_phone;
        $supplier->supplier_address = $request->supplier_address;
        $supplier->supplier_email = $request->supplier_email;
        $supplier->description = $request->description;
        $supplier->adding_date = $todayDate;

        if ($supplier->save()) {
            $request->session()->flash('message', 'Supplier successfully added');
            return redirect()->route('supplier.index');
        } else {
            return redirect()->route('supplier.create')
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
        if (request()->ajax()) {
            $data = Supplier::findOrFail($id);
            return response()->json(['result' => $data]);
        }
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
        $supplier = Supplier::findOrFail($uid);
        return view('pages.manage_supplier.edit', compact('supplier'));
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
                'supplier_name' => 'required',
                'supplier_phone' => 'required',
                'supplier_address' => 'required',
                'supplier_type' => 'required',
            ],
            [
                'supplier_name.required' => 'Name required',
                'supplier_phone.required' => 'Phone Number required',
                'supplier_address.required' => 'Address required',
                'supplier_type.required' => 'Supplier Type  required',
            ]
        );

        // Storing database
        $supplier = Supplier::find($id);
        $supplier->supplier_name = $request->supplier_name;
        $supplier->supplier_type = $request->supplier_type;
        $supplier->supplier_phone = $request->supplier_phone;
        $supplier->supplier_address = $request->supplier_address;
        $supplier->supplier_email = $request->supplier_email;
        $supplier->description = $request->description;
        $supplier->save();
        $request->session()->flash('message', 'Supplier successfully Updated');
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function delete(Request $request)
    {
        $data = Supplier::destroy($request->supplier_id);
    }


}
