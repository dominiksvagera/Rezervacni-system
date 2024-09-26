<?php

namespace App\Http\Controllers;
use App\Models\rezervace;
use Illuminate\Http\Request;

class AuthController extends Controller
{
public function show()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        dd($request->email, $request->password);
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

    dd($validated);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
    ]);

return to_route('index');

}
}

