<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\checkCapacity;

class DashboardController extends Controller
{
    // napárování rezervací a lekcí do dashboardu
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
// založní nové lekce na dashboardu i s ohlídáním kapacity 
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
// zrušení rezervace
public function destroy(Request $request)
{
    $reservation = Reservation::find($request->id);
    $reservation->delete();

    return redirect()->route('dashboard');
}
// update rezervace
public function update(Request $request)
{
    $reservation = Reservation::find($request->id);
    $reservation->update();

    return redirect()->route('dashboard');
}
// slouží k výpusu rezervací :
public function showReservations()
{
    // Získání všech rezervací z databáze
    $reservations = Reservation::all();

    // Předání rezervací do view
    return view('pages.rezervace', compact('reservations'));
}
}