<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Povolené atributy pro hromadné přiřazení (mass assignment)
    protected $fillable = ['user_id', 'name', 'email', 'date', 'lesson_id'];

    protected $casts = [
        'reservation' => 'datetime:Y-m-d', // Castujeme reservation_date na správný formát
    ];

    // Relace - rezervace patří uživateli
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}