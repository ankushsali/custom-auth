<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Session;

class AuthController extends Controller
{
    public function register(Request $request) {
        if ($request->isMethod('POST')) {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric',
                'password' => 'required'
            ]);

            User::create($data);

            return redirect()->route('register')->with('success', 'Registration successfully');
        }else{
            return view('auth.register');
        }
    }

    public function login(Request $request) {
        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if(Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])){
                return redirect()->route('dashboard')->with('success', 'User logged in');
            }else{
                return redirect()->route('login')->with('error', 'Invalid login credentials');
            }
        }else{
            return view('auth.login');
        }
    }

    public function dashboard() {
        return view('auth.dashboard');
    }

    public function profile(Request $request) {
        if ($request->isMethod('POST')) {
            $data = $request->validate([
                'name' => 'required',
                'phone' => 'required|numeric'
            ]);
            
            /* User::where('id', auth()->user()->id)->update($data); */

            $user = User::findOrFail(auth()->user()->id);
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->save();
            
            return redirect()->route('dashboard')->with('success', 'Profile updated successfully');
        }else{
            return view('auth.profile');
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    public function testing() {
        $user = User::findOrFail(1);
        return response()->json($user);
    }
}
