<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Povolené atributy pro hromadné přiřazení (mass assignment)
    protected $fillable = ['user_id', 'name', 'email', 'date', 'reservation'];

    // Relace - rezervace patří uživateli
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}