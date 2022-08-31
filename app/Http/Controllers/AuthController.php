<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function store(Request $request)
    {
        # validate
        $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        # get user
        $user = User::where([
            ['email', $request->email],
            ['role', 'Admin']
        ])->first();

        #check user
        if (!$user) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'User tidak ditemukan.']);;
        }

        # check password
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withInput()
                ->withErrors(['password' => 'Password salah!']);;
        }

        #add session
        Auth::login($user, $request->remember);

        #return
        return redirect()->route('voting.index');
    }


    public function logout(Request $request)
    {
        $role = Auth::user()->role;

        $request->session()->flush();
        Auth::logout();

        if ($role == 'Admin') {
            return redirect()->route('login.index');
        } else {
            return redirect()->route('main.index');
        }
    }
}
