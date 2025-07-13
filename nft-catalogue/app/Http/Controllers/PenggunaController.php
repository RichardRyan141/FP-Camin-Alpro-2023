<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*$username = session('username');
        $user = Pengguna::where('name', '=', $username)->first();
        $user->loadCount('nft');
        return view('pengguna.index', compact('user'));*/

        $username = session('username');
        $user = null;
    
        if ($username == 'Admin') {
            $user = Pengguna::withCount('nft')->get();
            return view('admin.index', compact('user'));
        } else {
            $user = Pengguna::where('name', '=', $username)->first();
            $user->loadCount('nft');
            return view('pengguna.index', compact('user'));
        }    
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (session('username') == '')
        {
            return view('session.register');
        }
        else
        {
            $penggunas = Pengguna::all();
            return view ('admin.register-user', compact('penggunas'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:TabelPengguna,name',
            'password' => 'required|between:8,12|confirmed',
        ],
        [
            'nama.required' => 'Name can\'t be empty!',
            'nama.unique' => 'This name is already taken!',
            'password.required' => 'Password can\'t be empty!',
            'password.between' => 'Password must be between 8 and 12 characters long',
            'password.confirmed' => 'Passwords do not match!',
        ]);

        Pengguna::create([
            'name' => $request->nama,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/user');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $username = session('username');
        $pengguna = Pengguna::where('name', '=', $username)->first();
        return view('pengguna.edit-password', compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        $username = session('username');
        $pengguna = Pengguna::where('name', '=', $username)->first();

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|between:8,12|confirmed',
        ],
        [
            'current_password.required' => 'Old password can\'t be empty!',
            'new_password.required' => 'New Password can\'t be empty!',
            'new_password.between' => 'New Password must be between 8 and 12 characters long',
            'new_password.confirmed' => 'Passwords do not match!',
        ]);
    
        if (!Hash::check($validatedData['current_password'], $pengguna->password)) {
            return redirect('/user/change-password')->with('error', 'Incorrect current password');
        }
    
        $pengguna->password = Hash::make($validatedData['new_password']);
        $pengguna->save();
    
        return redirect('/user')->with('error', 'Password changed successfully');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $username = session('username');
        $pengguna = Pengguna::where('name', '=', $username)->first();
        $toBeDeleted = Pengguna::find($id);
        if ($username === 'Admin' && $toBeDeleted->name !== 'Admin') {
            $toBeDeleted->delete();
            return redirect('/user')->with('success', 'User deleted successfully');
        } elseif ($pengguna->uid == $id) {
            $toBeDeleted->delete();
            return redirect('/')->with('success', 'User deleted successfully');
        } else {
            return redirect('/user')->with('error', 'Unauthorized access');
        }    
    }
}
