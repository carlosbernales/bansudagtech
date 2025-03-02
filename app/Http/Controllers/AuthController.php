<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; // for generating a random token
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Models\Farms;
use App\Models\Announcement;
use App\Mail\RegisterVerification;
use App\Mail\ResetPassword;



class AuthController extends Controller
{

    public function landingpage()
    {
        if (session()->has('admin_id')) {
            return redirect('/dashboard');
        } elseif (session()->has('user_id')) {
            return redirect('/home');
        }
        $farms = Farms::all();
        $announcements = Announcement::orderBy('id', 'desc')->take(3)->get();
        $defaultLocation = Farms::first()?->location ?? null;
        
        return view('landing_page', compact('farms','defaultLocation','announcements'));
    }

    public function login()
    {
        if (session()->has('admin_id')) {
            return redirect('/dashboard');
        } elseif (session()->has('user_id')) {
            return redirect('/home');
        }
        $farms = Farms::all();
        $defaultLocation = Farms::first()?->location ?? null;
        
        return view('login', compact('farms','defaultLocation'));
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $account = Accounts::where('email', $request->email)->first();

        if ($account) {
            if ($account->status != 'verified') {
                return redirect()->back()->with('error', 'Your account is not verified');
            }

            if (!Hash::check($request->password, $account->password)) {
                return redirect()->back()->with('error', 'Incorrect password');
            }

            session()->flush();

            if ($account->role == 'user') {
                session(['user_id' => $account->id]);
                return redirect('/home');
            } elseif ($account->role == 'admin') {
                session(['admin_id' => $account->id]);
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
    
        if (Accounts::where('email', $request->email)->exists()) {
            return redirect()->back()
                ->withErrors(['email' => 'The email already exists.'], 'register_error')
                ->withInput();
        }
    
        $account = Accounts::where('rsbsa', $request->rsbsa)->first();
        if (!$account) {
            return redirect()->back()
                ->withErrors(['rsbsa' => 'The RSBSA record was not found.'], 'register_error')
                ->withInput();
        }
    
        $verificationToken = Str::random(60);
        $url = URL::route('email.verify', ['token' => $verificationToken]);
    
        try {
            Mail::to($request->email)->send(new RegisterVerification($url));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('alertify_error', 'Failed to send verification email. Try to contact the administrator.')
                ->withInput();
        }
    
        $account->update([
            'email' => $request->email,
            'status' => 'not_verified',
            'password' => Hash::make($request->password),
            'verification_token' => $verificationToken,
        ]);
    
        return redirect()->back()->with('success', 'Registration successful! Please check your email for the verification link.');
    }


    public function verifyEmail(Request $request, $token)
    {
        $account = Accounts::where('verification_token', $token)->first();

        if (!$account) {
            return redirect('/login')->with('alertify_error', 'Invalid link.');
        }

        $account->update([
            'verification_token' => null, 
            'status' => 'verified', 
        ]);


        return redirect('/login')->with('success', 'Your email has been verified. You can now login.');
    }

    public function reset_password()
    {
        if (session()->has('admin_id')) {
            return redirect('/dashboard');
        } elseif (session()->has('user_id')) {
            return redirect('/home');
        }
        
        return view('user/reset_password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $account = Accounts::where('email', $request->email)->first();
    
        if (!$account) {
            return back()->with('alertify_error', 'Email does not exist.');
        }
    
        $token = bin2hex(random_bytes(50));
        $account->email_token = $token;
        $account->save();
    
        $resetLink = url("/reset_password/$token");
    
        try {
            Mail::to($request->email)->send(new ResetPassword($resetLink));
        } catch (\Exception $e) {
            return back()->with('alertify_error', 'Failed to send reset email. Please try again later.');
        }
    
        return back()->with('success', 'Reset link sent to your email.');
    }

    public function showResetForm($token)
    {
        $account = Accounts::where('email_token', $token)->first();

        if (!$account) {
            return redirect('/login')->with('alertify_error', 'Invalid link.');
        }

        return view('user.reset_password', ['token' => $token]);
    }

    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $account = Accounts::where('email_token', $token)->first();

        if (!$account) {
            return redirect('/login')->with('alertify_error', 'Invalid link.');
        }

        $account->password = Hash::make($request->password);
        $account->email_token = null; 
        $account->save();

        return redirect('login')->with('success', 'Password reset successfully.');
    }

    public function logout()
    {
        Auth::logout(); 
        session()->flush();

        return redirect('/'); 
    }

}
