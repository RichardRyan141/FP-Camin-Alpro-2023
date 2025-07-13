<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;


class LoginController extends Controller
{
    function index()
    {
        return view("session/login");
    }

    function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ],
        [
            'name.required' => 'Username can\'t be empty!',
            'password.required' => 'Password can\'t be empty!',
        ]);

        $user = Pengguna::where('name', '=', $request->name)->first();
        if (!$user) {
            return redirect('/')->with('error', 'User not found');
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect('/')->with('error', 'Incorrect Password');
        }

        session(['username' => $user->name]);

        //return redirect('/')->with('error', session('username'));
        return redirect('/user');
    }

    function logout()
    {
        Auth::logout();
        session(['username' => '']);
        return redirect('/')->with('error', 'Logout success');    
    }
}
