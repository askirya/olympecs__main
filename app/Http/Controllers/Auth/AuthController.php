<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[\p{Cyrillic}\s]+$/u',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'department' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'department' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('tickets.index');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';
        $credentials = [
            $field => $request->email,
            'password' => $request->password
        ];

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('tickets.index');
    }

    return back()->withErrors([
        'email' => 'Неверные учетные данные.',
    ])->withInput();
}

// ... existing code ...

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}