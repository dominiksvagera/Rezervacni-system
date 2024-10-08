<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Zobrazí hlavní stránku s kalendářem
    public function index()
    {
        $reservations = Reservation::all();
        return view('pages.rezervace', compact('reservations'));
    }

    // Uloží novou rezervaci
    public function store(Request $request)
    {
        // Validace vstupů
        $request->validate([
            'date' => 'required|date',
            'jmeno' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Kontrola, jestli už nejsou 3 rezervace pro daný den
        $reservations = Reservation::where('date', $request->date)->count();

        if ($reservations >= 3) {
            return redirect()->back()->withErrors('Kapacita pro tento den je plná.');
        }

        // Vytvoření nové rezervace
        Reservation::create([
            'user_id' => Auth::id(),  // Uložení ID přihlášeného uživatele
            'name' => $request->jmeno,
            'email' => $request->email,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Rezervace úspěšně přidána!');
    }

    // Zruší rezervaci pro daný den
    public function destroy($date)
    {
        // Najdi rezervaci podle data a ID uživatele
        $reservation = Reservation::where('date', $date)
            ->where('user_id', Auth::id())
            ->first();

        if ($reservation) {
            $reservation->delete();
            return redirect()->back()->with('success', 'Rezervace úspěšně zrušena.');
        }

        return redirect()->back()->withErrors('Rezervaci nelze zrušit.');
    }
}