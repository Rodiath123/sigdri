<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
        'est_actif',
        'industriel_id',
        'dernier_connexion',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'est_actif' => 'boolean',
        'dernier_connexion' => 'datetime',
    ];

    // Relation vers l'unité industrielle
    public function uniteIndustrielle()
    {
        return $this->belongsTo(UniteIndustrielle::class, 'industriel_id');
    }
}