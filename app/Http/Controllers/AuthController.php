<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as IpRequest;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            $log = new Log();
            $log->ip = IpRequest::ip();
            $log->user_id = Auth::id();
            $log->action = 'Giriş Yapıldı';
            $log->save(); 

            return redirect()->intended('/' . $user->roles->first()->role_name . '/dashboard'); // İlk role göre yönlendirme
        }

        return back()->withErrors(['email' => 'Email ya da şifre hatalı.']);
    }

    public function logout()
    {
        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Çıkış Yapıldı';
        $log->save(); 

        Auth::logout();
        return redirect('/login');
    }
}
