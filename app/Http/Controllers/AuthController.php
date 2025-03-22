<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $remember = $request->has('remember') ? true : false;
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Logged in successfully!');
        }
    
        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ])->onlyInput('username');
    }

    public function sendEmail()
    {
        $details = [
            'title' => 'Mail from Laravel App',
            'body' => 'This is a test email sent from Laravel.'
        ];

        Mail::to('bagus.candrabudi@gmail.com')->send(new SendEmail($details));

        return "Email has been sent!";
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
