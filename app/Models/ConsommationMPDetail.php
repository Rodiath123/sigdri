<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsommationMPDetail extends Model
{
    protected $table = 'consommation_mp_details';
    
    protected $fillable = [
        'declaration_id', 'matiere_premiere_id', 'quantite_utilisee',
    ];

    public function matierePremiere()
    {
        return $this->belongsTo(MatierePremiere::class);
    }
}