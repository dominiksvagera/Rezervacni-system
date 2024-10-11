<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'start_at', 'end_at', 'capacity'];  


public function reservations()
{
    return $this->hasMany(Reservation::class);
}
}