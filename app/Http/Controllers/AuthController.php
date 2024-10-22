<?php
namespace App\Http\Controllers;
 
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller

{

    public function show()
    {
        return view('pages.login');
    }
// autentifikace uživatele pomocí mailu a hesla
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Zadané přihlašovací údaje nejsou správné',
        ])->onlyInput('email');
    }
// registrace nového uživatele
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:8',
                'password' => 'required|min:8',
            ],

        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password' => $request->password,
        ]);

        return redirect('/');
    }

    // odhlášení
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function register()
    {
        return view('pages.register');
    }


    public function rezervace()
    {
        return view('pages.rezervace');
    }
 
}