<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionDetail extends Model
{
    protected $fillable = [
        'declaration_id', 'produit_id', 'quantite_produite',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}