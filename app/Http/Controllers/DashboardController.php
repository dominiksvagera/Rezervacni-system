<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
       
        $user = Auth::user();
    
        return view('pages.dashboard');
    }
}