<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use Authenticatable;

    public function signIn(): View
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
                                      'The provided credentials do not match our records.',
                                  ]);
    }

    public function signOut(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('/');

    }
}
