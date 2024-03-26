<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $casts = [
        'strengths' => 'array'
    ];

    public function poste()
    {
        return $this->belongsTo(Poste::class);
    }

    public function getImagePathAttribute()
    {
        return asset('storage/images/employers/' . ($this->image ?? 'default-worker.jpeg'));
    }
    public function getSexeFullAttribute($val)
    {
        return $val == 'b' ? 'Homme' : 'Femme';
    }
}
