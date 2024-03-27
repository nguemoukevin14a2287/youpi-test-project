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
    public function getGradeAttribute()
    {
        return $this->poste ? $this->poste->grade : null;
    }

    public function getImagePathAttribute()
    {
        return asset('storage/images/employers/' . ($this->image ?? 'default-worker.jpeg'));
    }
    public function getSexeFullAttribute($val)
    {
        return $this->sexe == 'b' ? 'Homme' : 'Femme';
    }
    public function getNameFullAttribute($val)
    {
        $str = 'M. ';
        if($this->sexe == 'g'){
            if($this->civility == 'marié'){
                $str = 'Mme. ';
            } else {
                $str = 'Mlle. ';
            }
        }
        return $str . $this->name;
    }
    public function getAgeAttribute()
    {
        return date_diff(date_create(), date_create($this->birthday))->format('%y ans');
    }
    public function getAgeWorkAttribute()
    {
        $diff = date_diff(date_create(), date_create($this->joined_at));
        $m = $diff->format('%y') * 12 + $diff->format('%m');
        return [
            'all' => $diff->format('%y ans %m mois et %d jours'),
            'months' => $m . ' mois',
            'years' => $diff->format('%y ans'),
            'days' => $diff->format('%a jours')
        ];
        return date_diff(date_create(), date_create($this->joined_at))->format('%y ans');
    }
    public function getJoinedAtFullAttribute()
    {
        return date('D jS M Y', strtotime($this->joined_at));
    }
    public function getBirthdayFullAttribute($val)
    {
        return date('D jS M Y', strtotime($this->birthday));
    }
}
