<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityLog;
use App\User;
use App\Setting;
use Auth;
use DataTables;
use DateTime;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function activityLog(Request $request)
    {
        //dd($data);
        //$data = ActivityLog::with('user')->get();
        // dd($data);

        if ($request->ajax()) {
            $data = ActivityLog::get();
           return DataTables::of($data)
            ->make(true);
            //return $data;
        }
        return view('pages.setting.activitylog');
    }

    public function remainderSetting(Request $request)
    {
        $setting = Setting::find(1);
        return view('pages.setting.remainder', compact('setting'));
    }

    public function remainderChange(Request $request)
    {
        $setting = Setting::find(1);
        $setting->user_id = Auth::user()->id;
        $setting->setting_day = $request->setting_day;
        $setting->settings_quantity = $request->settings_quantity;
        $setting->save();
        $request->session()->flash('message', 'Settings Upadted');
        return redirect()->route('setting.remainder');
    }
}
