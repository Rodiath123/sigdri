<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueDeclaration extends Model
{
    protected $fillable = [
        'declaration_id', 'utilisateur_id', 'action',
        'ancienne_valeur', 'nouvelle_valeur',
    ];

    protected $casts = [
        'ancienne_valeur' => 'array',
        'nouvelle_valeur' => 'array',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}