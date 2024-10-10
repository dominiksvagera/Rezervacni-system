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
        $reservations = Reservation::where('reservation', 'like', $currentMonth . '%')->get();
        $lessons = Lesson::all();

        return view('pages.rezervace', [
            'reservations' => $reservations,
            'lessons' => $lessons,
        ]);
    }

    public function getReservationsByMonth($month)
    {
        // Získání rezervací pro daný měsíc
        $reservations = Reservation::where('reservation', 'like', $month . '%')->get();

        return response()->json($reservations);
    }

}