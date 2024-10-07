<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
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
    $reservation = $reservation::find($request->id);
    $reservation->delete();

    return redirect()->route('dashboard');
}

}