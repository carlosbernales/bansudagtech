<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function landingpage()
    {
        // if (!session()->has('admin_id') && !session()->has('it_id')) {
        //     return redirect('/');
        // }
        
    
        return view('landing_page');
    }

    public function login()
    {
        // if (!session()->has('admin_id') && !session()->has('it_id')) {
        //     return redirect('/');
        // }
        return view('login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $account = Accounts::where('email', $request->email)->first();

        if ($account && !Hash::check($request->password, $account->password)) {
            return redirect()->back()->with('error', 'Incorrect password');
        }

        if ($account) {
            if ($account->role == 'user') {
                Session::put('user_id', $account->id);
                return redirect('/home');
            } elseif ($account->role == 'admin') {
                Session::put('admin_id', $account->id);
                return redirect('/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Account not found');
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'rsbsa' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'register_error')
                ->withInput();
        }

        // Check if the email already exists in the database
        if (Accounts::where('email', $request->email)->exists()) {
            return redirect()->back()
                ->withErrors(['email' => 'The email existed.'], 'register_error')
                ->withInput();
        }

        // Check if the RSBSA record exists
        $account = Accounts::where('rsbsa', $request->rsbsa)->first();
        if (!$account) {
            return redirect()->back()
                ->withErrors(['rsbsa' => 'The RSBSA record was not found.'], 'register_error')
                ->withInput();
        }

        // Update the existing account with the new email and password
        $account->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Registration successful!');
    }

}
