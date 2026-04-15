<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatierePremiere extends Model
{
    protected $fillable = [
        'nom', 'origine', 'filiere', 'est_actif',
    ];

    protected $casts = [
        'est_actif' => 'boolean',
    ];
}