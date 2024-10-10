<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Reservation;
use App\Models\Lesson;

class checkCapacity implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //----- přijde lesson_id 
        
        //--- kouknu do tabulky reservations kolik tam je záznamu s tímto lesson id 
        $pocetRezervaci =  Reservation::where('lesson_id', $value)->count();

        //---- kouknu do tabulky lessons kolik má kapacitu lesson s tímto lesson id 
        $capacity = Lesson::find($value)->capacity;

        // porovnám počet rezervací s tímto lesson id a kapacitu lesson s tímto id 

        if ($pocetRezervaci >= $capacity)
        {
            $fail('Na tuto lekci je již registrován plný počet uživatelů');
        }
       
    }
        
}
