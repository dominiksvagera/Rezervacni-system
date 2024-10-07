<?php

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

    public function login(Request $request)
    {
        return view('pages.dashboard');
    }

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
            'email' => 'Zadané přihlašovací údaje nejsou správné.',
        ])->onlyInput('email');
    }


public function register()
{
    return view('pages.register');
}

 
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|min:2',
        'email' => 'required|unique:users,email',
        'password' => 'required|min:6',
    
    ],
[
    'email.unique' => 'Uživatel s tímto emailem už existuje.',
    'password.min' => 'Heslo je příliš krátké, zadejte alespoň 6 zanků.',
]
);



    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
    ]);

return redirect('/');

}

    public function rezervace()
    {
        return view('pages.rezervace');
    }

  

    public function logout(Request $request): RedirectResponse
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
}
}