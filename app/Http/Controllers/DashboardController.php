<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\checkCapacity;

class DashboardController extends Controller
{
    public function show()
    {
       
        $reservations = Reservation::where("user_id", Auth::id())->get();
        $lessons = Lesson::all();
    
        return view('pages.dashboard', [
            "reservations" => $reservations,
            'lessons' => $lessons,
            'title' => $lessons,
        'date' => $lessons,
        'start_at' => $lessons,
        'end_at' => $lessons,
]);
    }

public function store(Request $request)
{

    $validated = $request->validate([
        'lesson' =>  ['required', new checkCapacity],
      
    ],[
        'lesson.required' => 'Vyplňte prosím Vaši rezervaci',
      
    ]);

    $reservation = Reservation::create([
        'lesson_id' => $request->lesson,
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

public function update(Request $request)
{
    $reservation = Reservation::find($request->id);
    $reservation->update();

    return redirect()->route('dashboard');
}

public function showReservations()
{
    // Získání všech rezervací z databáze
    $reservations = Reservation::all();

    // Předání rezervací do view
    return view('pages.rezervace', compact('reservations'));
}
}