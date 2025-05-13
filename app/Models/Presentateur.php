<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentateur extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'statut'];

    // Relation avec Seminaire
    public function seminaires()
    {
        return $this->hasMany(Seminaire::class);
    }
}
