<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function employers()
    {
        return $this->hasMany(Employer::class);
    }
}
