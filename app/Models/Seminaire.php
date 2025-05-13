<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'date_presentation',
        'resume',
        'fichier',
        'presentateur_id',
        'theme_id'
    ];

    // Relation avec Presentateur
    public function presentateur()
    {
        return $this->belongsTo(Presentateur::class);
    }

    // Relation avec Theme
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
