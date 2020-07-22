<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;
use DateTime;

class ExecutiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::where('user_type', '!=',"admin")
                ->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {

                    $button = '<a href="'.route('executive.show', base64_encode($data->id)) . '"> <button class="edit btn btn-info btn-sm" >Details</button></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href="'.route('executive.edit', base64_encode($data->id)) . '"> <button class="edit btn btn-primary btn-sm" >Edit Profile</button></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.manage_executive.index');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.manage_executive.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    // Validation

        $request->validate(
            [
                'user_name' => 'required',
                'user_phone' => 'required',
                'email' => 'required|unique:users',
                'joining_date' => 'required',
                'password' => 'required',
                'image'   => 'required',
            ],
            [
                'user_name.required' => 'Executive Name required',
                'user_phone.required' => 'Executive Phone required',
                'joining_date.required' => 'Joining Date required',
                'image.required' => 'Valid Image required',

            ]
        );

        //image process
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('/public/images', $filename);
            $file->move('public/images', $file->getClientOriginalName());
        }

        // Storing database

        $User = new User();
        $User->user_name = $request->user_name;
        $User->user_type = "executive";
        $User->user_phone = $request->user_phone;
        $User->email = $request->email;
        $User->joining_date = $request->joining_date;
        $User->user_address = $request->user_address;
        $User->password = bcrypt($request->password);
        $User->image=$path;
        $User->status="1";


        if ($User->save()) {
            $request->session()->flash('message', 'Executive has been successfully added');
            return redirect()->route('executive.index');
        } else {
            return redirect()->route('executive.create')
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
        $uid = base64_decode($id);
        $user = User::findOrFail($uid);
        return view('pages.manage_executive.details',compact('user'));
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
        $user = User::findOrFail($uid);
        return view('pages.manage_executive.edit', compact('user'));
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
        $uid = base64_decode($id);

        $request->validate(
            [
                'user_name' => 'required',
                'user_phone' => 'required',
                'email' => 'required',
                'joining_date' => 'required',
            ],
            [
                'user_name.required' => 'Executive Name required',
                'user_phone.required' => 'Executive Phone required',
                'joining_date.required' => 'Joining Date required',


            ]
        );

        //image process
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('/public/images', $filename);
            $file->move('public/images', $file->getClientOriginalName());
        }
        else
        {
            $path = $request->oldimage;
        }

        //Password check

        if(isset($request->password))
        {
            $password = bcrypt($request->password);

        }
        else
        {
            $password = $request->old_password;
        }



        // Update database
        $User = User::find($uid);
        $User->user_name = $request->user_name;
        $User->user_phone = $request->user_phone;
        $User->email = $request->email;
        $User->joining_date = $request->joining_date;
        $User->user_address = $request->user_address;
        $User->password = $password;
        $User->image = $path;
        $User->status = $request->status;
        $User->save();


        $request->session()->flash('message', 'Profile Upadated');

        if($User['user_type'] =="admin")
        {
            return redirect(route('executive.show', base64_encode($User['id'])));
        }
        else
        {
            return redirect(route('executive.index'));
        }


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
