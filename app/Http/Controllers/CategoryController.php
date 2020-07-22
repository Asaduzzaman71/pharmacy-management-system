<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use Auth;
use DataTables;

class CategoryController extends Controller
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
            $data = Category::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){

                        $button = '<a href="'.route('Category.edit',base64_encode($data->id)).'"> <button class="edit btn btn-primary btn-sm" type="submit" > Edit</button></a>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.medicine_category.index');

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.medicine_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $category=new Category();
        $request->validate([
            'category_name' => 'required|max:255|unique:categories',
            'category_description' =>'required|max:1000',
            'status' => 'required|max:100',
        
            ]);
      $category->category_name=strtoupper($request->category_name);
      $category->category_description=$request->category_description;
      $category->created_by=Auth::user()->user_name;
      $category->updated_by=NULL;   
      $category->status=$request->status;

      $category->save();
      Session::flash('message','Category inserted successfully!!!!');
      return redirect(route('Category.index'));
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
        $categoryid=base64_decode($id);
        $category = Category::findOrFail($categoryid);

        return view('pages.medicine_category.edit',compact('category'));
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
        $category=Category::find($id);
        $request->validate([
            'category_name' => 'required|max:255',
            'category_description' =>'required|max:1000',
            'status' => 'required|integer',
        
            ]);

      $category->category_name=$request->category_name;
      $category->category_description=$request->category_description;
      $category->created_by=$category->created_by;
      $category->updated_by=Auth::user()->user_name; 
      $category->status=$request->status;
     
      $category->save();
      Session::flash('message','Category updated successfully!!!!');
      return redirect(route('Category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

         $category=Category::find($request->category_id);
         $category->delete();
         Session::flash('message','Category deleted successfully!!!!');
         return redirect(route('Category.index'));
    }
}
