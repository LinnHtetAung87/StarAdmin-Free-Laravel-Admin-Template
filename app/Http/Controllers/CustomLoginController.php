<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomLoginController extends Controller
{
    //
    public function login() {
        return view('auth.login');
    }
    public function loginpost(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('name','password');
        if (Auth::attempt($credentials)) {
             return redirect('dashboard');
        } else {
            return redirect('login')->with('warning','Login is invalid');
        }
        //dd($request->all());
    }
    public function register() {
        return view('auth.register');
    }
    public function registerpost(Request $request) {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $data=$request->all();
        $this->create($data);
        return redirect('login');
        //dd($request->all());
        //return redirect('login');
    }
    public function create(array $data) {
        return User::create([
            'name' => $data['full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function signout() {
        Session::flush();
        Auth::logout();
        return redirect('login')->with('success','Logout is Successfully');
    }

}
