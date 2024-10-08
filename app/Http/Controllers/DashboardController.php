<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
       
        $reservations = Reservation::where("user_id", Auth::id())->get();
    
        return view('pages.dashboard', ["reservations" => $reservations]);
    }

public function store(Request $request)
{

    $validated = $request->validate([
        'reservation' => 'required',
      
    ],[
        'reservation.required' => 'Vyplňte prosím Vaši rezervaci',
      
    ]);

    $reservation = Reservation::create([
        'reservation' => $request->reservation,
        'user_id' => Auth::user()->id,
    ]);

    return redirect()->route('dashboard');
    
    }

public function destroy(Request $request)
{
    $reservation = Reservation::find($request->id);
    $reservation->delete();

    return redirect()->route('dashboard');
}

}