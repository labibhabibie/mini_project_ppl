<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function authenticate()
	{
		$credentials = request()->only(['email', 'password']);


		if (Auth::attempt($credentials)) {

			$userRole = auth()->user()->role;

			switch ($userRole) {
				case "admin":
					return redirect()->intended('admin');

					break;
				case "user":
					return redirect()->intended('user');

					break;
				default:
					redirect()->to('/');
			}
		}
	
		return back()->with('error', 'Invalid login crendentials');
	}
}
