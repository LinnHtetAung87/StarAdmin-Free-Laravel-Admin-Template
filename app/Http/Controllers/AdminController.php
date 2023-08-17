<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function dashboard() {
       if (Auth::check()) {
        return view('admin.dashboard');
       }else {
        return redirect('login')->withSuccess('Please!, Login');
       }


    }
}
