<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminates\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
       
        $reservations = $reservation::where("user_id", Auth::id())->get();
    
        return view('pages.dashboard', ["reservations" => $reservation]);
    }

public function store(Request $request)
{
    $reservation = Reservation::creat([
        'reservation' => $request->reservation,
        'user_id' => Auth::id(),
    ]);

    return redirect()->route('dashboard');
    
    }

}