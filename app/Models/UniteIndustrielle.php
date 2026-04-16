<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniteIndustrielle extends Model
{
   protected $fillable = [
    'nom', 'localisation', 'departement', 'filiere', 
    'capacite_installee', 'regime', 'contact_nom', 
    'contact_telephone', 'contact_email', 'est_actif'
]; 

    protected $casts = [
        'est_actif' => 'boolean',
        'capacite_installee' => 'decimal:2',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'industriel_id');
    }

    public function declarations()
    {
        return $this->hasMany(Declaration::class);
    }

    public function alertesMP()
    {
        return $this->hasMany(AlerteMP::class);
    }
}