<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom', 'unite', 'filiere', 'est_actif',
    ];

    protected $casts = [
        'est_actif' => 'boolean',
    ];
}