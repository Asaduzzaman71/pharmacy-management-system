<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expensecategory;
use App\Expense;
use Session;
use Auth;
use DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 
    // $data = Expense::with('Expensecategory')->get();
     //dd($data); 

   if ($request->ajax()) {
    $data = Expense::with('Expensecategory')->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('expense.show',($data->id)) . '"> <button class="edit btn btn-info btn-sm" type="submit" >Details</button></a>';
                    
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('pages.manage_expenses.expenses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $expense_categories=Expensecategory::all();
         
         return view('pages.manage_expenses.expenses.create',compact('expense_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expense=new Expense();
        $request->validate([
            'title' => 'required|max:255',
            'expense_category_id' =>'required',
            'expense_amount'=>'required',
            'expense_date'=>'required|date',
            'expense_description'=>'required|max:1000',
            
        
            ]);
      $expense->title=$request->title;
      $expense->expense_category_id=$request->expense_category_id;
      $expense->expense_amount=$request->expense_amount;
      $expense->expense_date=$request->expense_date;
      $expense->expense_description=$request->expense_description;
      $expense->created_by=Auth::user()->user_name;
      $expense->updated_by=NULL;
      $expense->save();
      Session::flash('message','expense inserted successfully!!!!');
      return redirect(route('expense.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        
        $expense = Expense::findOrFail($id);
       
        return view('pages.manage_expenses.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
