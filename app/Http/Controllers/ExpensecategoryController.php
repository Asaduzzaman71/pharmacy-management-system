<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Expensecategory;
use Session;
use Auth;
use DataTables;



class ExpensecategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Expensecategory::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){

                        $button = '<a href="'.route('expense-category.edit',base64_encode($data->id)).'"> <button class="edit btn btn-primary btn-sm" type="submit" > Edit</button></a>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.manage_expenses.expense_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('pages.manage_expenses.expense_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $expense_category=new Expensecategory();
        $request->validate([
            'expense_category_name' => 'required|max:255|unique:expensecategories',
            'expense_category_description' =>'required|max:1000',
            'status' => 'required|integer',
        
            ]);
      $expense_category->expense_category_name=strtoupper($request->expense_category_name);
      $expense_category->expense_category_description=$request->expense_category_description;
      $expense_category->created_by=Auth::user()->user_name;
      $expense_category->updated_by=NULL;
      $expense_category->status=$request->status;
      $expense_category->save();
      Session::flash('message','expense category inserted successfully!!!!');
      return redirect(route('expense-category.index'));
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
        $expense_category_id=base64_decode($id);
        $expense_category = Expensecategory::findOrFail($expense_category_id);

        return view('pages.manage_expenses.expense_category.edit',compact('expense_category'));
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
        $expense_category=Expensecategory::find($id);
        $request->validate([
            'expense_category_name' => 'required|max:255',
            'expense_category_description' =>'required|max:1000',
            'status' => 'required|integer',
        
            ]);

      $expense_category->expense_category_name=$request->expense_category_name;
      $expense_category->expense_category_description=$request->expense_category_description;
      
      $expense_category->updated_by=Auth::user()->user_name;
      $expense_category->status=$request->status;  
      $expense_category->save();
      Session::flash('message','Expense Category updated successfully!!!!');
      return redirect(route('expense-category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $expense_category=Expensecategory::find($request->expense_category_id);
         $expense_category->delete();
         Session::flash('message','Expense Category deleted successfully!!!!');
         return redirect(route('expense-category.index'));
    }
}
