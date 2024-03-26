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
}
