<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek login via email atau nomor HP
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$fieldType => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['login' => 'Kredensial yang dimasukkan salah.']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

    if (!$request->email && !$request->phone) {
        return back()->withErrors(['login' => 'Mohon isi Email atau Nomor HP untuk registrasi.']);
    }

    // 1. Tampung data user yang baru dibuat ke dalam variabel $user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    // 2. Otomatis loginkan user yang baru mendaftar
    Auth::login($user);

    // 3. Regeneri session untuk keamanan (mencegah Session Fixation)
    $request->session()->regenerate();

    // 4. Redirect langsung ke halaman dashboard
    return redirect()->intended('/dashboard')->with('success', 'Registrasi sukses dan otomatis masuk!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}