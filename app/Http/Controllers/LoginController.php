<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\ActivityLog;

class LoginController extends Controller
{
    public function index()
    {

        return view('login.index');
    }


    //login user verify


    public function authenticated(Request $request)
    {


        $user = array(
            "email" => $request->email,
            "password" => $request->password,
            "status" => "1"
        );
         //dd(bcrypt($request->password));
        ///dd($this->getIp());


        if (Auth::attempt($user)) {

            $todayDate = date("Y-m-d");
            $time = date("h:i:s");
            $activityLogs = new ActivityLog();
            $activityLogs->user_name = Auth::user()->user_name;
            $activityLogs->activity = "login";
            $activityLogs->activity_date = $todayDate;
            $activityLogs->time = $time;
            $activityLogs->login_ip = $request->ip();
            $activityLogs->save();

            return redirect()->route('home.index');
        } else {

            $request->session()->flash('msg', 'invalid Email/password');
            return redirect()->route('login.index');
        }
    }

    public function SignOut()
    {

        Auth::logout();
        return redirect()->route('login.index');
    }
}
