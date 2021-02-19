<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
	function register(request $request)
	{
		$this->validate($request, [
			'nama' => 'min:4',
			'email' => 'unique:users',
			'password' => 'confirmed'
		]);
	    User::create([
	    	'name' =>$request->nama,
	    	'email' => $request->email,
	    	'password' => bcrypt($request->password)
	    ]);
	    return view('login.login');
	}

	function edit()
	{
		$user=Auth::user();
	    return view('auth.setting',['user'=>$user]);
	}

	function prosesedit(request $request)
	{
		if (isset($request->nama)) {
			$user=User::find($request->id);
			$user->name=$request->nama;
			$user->save();
		}else{
			$this->validate($request, [
				'password' => 'confirmed'
			]);
			$user->password=bcrypt($request->password);
			$user->save();
		}
	    return redirect('/admin');
	}
}
