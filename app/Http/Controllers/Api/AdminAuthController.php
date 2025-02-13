<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin) {
            Log::error('User not found: ' . $request->username);
            return back()->withErrors(['username' => 'Invalid credentials'])->with('error', 'Invalid username or password.');
        }

        if (!Hash::check($request->password, $admin->password)) {
            Log::error('Password mismatch for user: ' . $request->username);
            return back()->withErrors(['password' => 'Invalid credentials'])->with('error', 'Invalid username or password.');
        }

        Auth::login($admin);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}