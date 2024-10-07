<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'created_at_date',
        'reservation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
