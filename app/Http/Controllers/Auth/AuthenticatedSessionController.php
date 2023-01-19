<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticatedSession;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AuthenticatedSession $request)
    {
       
        $user = $request->only('email', 'password');
 
        if (Auth::attempt($user)) {
            $noti = [
                "error"=>false,
                "message"=>"User login successful",
                "alert-type"=>"success"
            ];
            return redirect()->route('dashboard')->with($noti);
        }

        $noti = [
            "error"=>false,
            "message"=>"Username and password incorrect!",
            "alert-type"=>"error"
        ];
        return redirect()->back()->with($noti);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

    
        return redirect('/');
    }
}
