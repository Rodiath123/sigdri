<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlerteMP extends Model
{
    protected $table = 'alerte_m_p_s';

    protected $fillable = [
        'unite_industrielle_id', 'matiere_premiere_id',
        'statut', 'commentaire', 'est_traitee',
        'traite_par', 'date_alerte', 'date_traitement',
    ];

    protected $casts = [
        'est_traitee'     => 'boolean',
        'date_alerte'     => 'datetime',
        'date_traitement' => 'datetime',
    ];

    public function uniteIndustrielle()
    {
        return $this->belongsTo(UniteIndustrielle::class);
    }

    public function matierePremiere()
    {
        return $this->belongsTo(MatierePremiere::class);
    }

    public function traitePar()
    {
        return $this->belongsTo(User::class, 'traite_par');
    }
}