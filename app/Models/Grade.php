<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    public function postes()
    {
        return $this->hasMany(Poste::class);
    }
    public function getEmployersAttribute()
    {
        return Employer::whereIn('poste_id', $this->postes()->pluck('postes.id'))
            ->selectRaw('employers.id, employers.poste_id, employers.name, matricule, birthday as birthday_full, joined_at as age_work')
            ->get();
    }
}
