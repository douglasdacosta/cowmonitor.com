<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;


class LogoutController extends Controller
{

    public function logout(){
        //echo "auth:" . Auth::user();
        Auth::logout();
        Session::flush();
        return redirect("/login");
    }
}