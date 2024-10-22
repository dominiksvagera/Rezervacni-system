<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Získání rezervací pro aktuální měsíc
        $currentMonth = Carbon::now()->format('Y-m');
        $reservations = Reservation::where('lesson_id', 'like', $currentMonth . '%')->get();
        $lessons = Lesson::all();

        return view('pages.rezervace', [
            'reservations' => $reservations,
            'lessons' => $lessons,
        ]);
        return view('lessons.index', compact('lessons'));
    }
    
// vytvoření lekce
    public function create()
    {
        return view('lessons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'start_at' => 'required',
            'end_at' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        Lesson::create($request->all());

        return redirect()->route('lessons.index')->with('success', 'Lekce byla úspěšně vytvořena');
    }

    public function getReservationsByMonth($month)
    {
        // Získání rezervací pro daný měsíc
        $reservations = Reservation::where('lesson_id', 'like', $month . '%')->get();

        return response()->json($reservations);
    }

}