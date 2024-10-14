<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Reservation extends Model
{
    use HasFactory;

    // Povolené atributy pro hromadné přiřazení (mass assignment)
    protected $fillable = ['user_id', 'name', 'email', 'date', 'lesson_id'];

    // Relace - rezervace patří uživateli
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }
}