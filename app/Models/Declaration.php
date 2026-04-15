<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    protected $fillable = [
        'unite_industrielle_id', 'annee', 'trimestre',
        'statut', 'commentaire_rejet', 'valide_par',
        'date_soumission', 'date_validation',
    ];

    protected $casts = [
        'date_soumission' => 'datetime',
        'date_validation' => 'datetime',
    ];

    public function uniteIndustrielle()
    {
        return $this->belongsTo(UniteIndustrielle::class);
    }

    public function productionDetails()
    {
        return $this->hasMany(ProductionDetail::class);
    }

    public function venteDetails()
    {
        return $this->hasMany(VenteDetail::class);
    }

    public function consommationMPDetails()
    {
        return $this->hasMany(ConsommationMPDetail::class);
    }

    public function historiques()
    {
        return $this->hasMany(HistoriqueDeclaration::class);
    }

    public function validePar()
    {
        return $this->belongsTo(User::class, 'valide_par');
    }
}