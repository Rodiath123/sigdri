<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenteDetail extends Model
{
    protected $table = 'vente_details';
    
    protected $fillable = [
        'declaration_id', 'produit_id', 'quantite_vendue', 'marche', 'chiffre_affaires'
    ];

    public function declaration()
    {
        return $this->belongsTo(Declaration::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}