@extends('layouts.app')

@section('title', 'Mon Profil')
@section('page-title', 'Mon Profil')
@section('page-subtitle', 'Gestion de vos informations personnelles')

@section('content')

<div class="row g-4">

    <!-- Carte profil -->
    <div class="col-md-4">
        <div class="card p-4 text-center">
            <div class="d-flex justify-content-center mb-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                     style="width:90px; height:90px; background:var(--primary); color:white; font-size:36px;">
                    {{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                </div>
            </div>
            <h5 class="fw-bold mb-0" style="color:var(--primary)">{{ Auth::user()->nom }}</h5>
            <p class="text-muted mb-2" style="font-size:13px;">{{ Auth::user()->email }}</p>
            <span class="badge rounded-pill mb-3"
                  style="background:#fee2e2; color:#dc2626; font-size:12px;">
                <i class="bi bi-shield-check me-1"></i>{{ ucfirst(Auth::user()->role) }}
            </span>

            <hr>

            <div class="text-start">
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Dernière connexion</small>
                    <small class="fw-semibold">
                        {{ Auth::user()->dernier_connexion ? \Carbon\Carbon::parse(Auth::user()->dernier_connexion)->format('d/m/Y H:i') : 'Première connexion' }}
                    </small>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Membre depuis</small>
                    <small class="fw-semibold">{{ Auth::user()->created_at->format('M Y') }}</small>
                </div>
                <div class="d-flex justify-content-between">
                    <small class="text-muted">Statut</small>
                    <span class="badge rounded-pill bg-success" style="font-size:11px;">● Actif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire informations -->
    <div class="col-md-8">
        <div class="card p-4 mb-4">
            <h6 class="fw-bold mb-4" style="color:var(--primary)">
                <i class="bi bi-person me-2" style="color:var(--secondary)"></i>
                Informations personnelles
            </h6>

            <form method="POST" action="{{ route('profil.update') }}">
                @csrf
                @method('PUT')
                
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom complet</label>
                        <input type="text" name="nom" class="form-control form-control-sm rounded-3" 
                               value="{{ old('nom', Auth::user()->nom) }}" required>
                        @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Email</label>
                        <input type="email" name="email" class="form-control form-control-sm rounded-3" 
                               value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Rôle</label>
                        <input type="text" class="form-control form-control-sm rounded-3" 
                               value="{{ ucfirst(Auth::user()->role) }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Service</label>
                        <input type="text" class="form-control form-control-sm rounded-3" 
                               value="{{ Auth::user()->uniteIndustrielle->nom ?? 'Ministère de l\'Industrie' }}" disabled>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold"
                                style="background:var(--secondary); color:white;">
                            <i class="bi bi-save me-1"></i> Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Changer mot de passe -->
        <div class="card p-4">
            <h6 class="fw-bold mb-4" style="color:var(--primary)">
                <i class="bi bi-lock me-2" style="color:var(--accent)"></i>
                Changer le mot de passe
            </h6>

            <form method="POST" action="{{ route('profil.update') }}">
                @csrf
                @method('PUT')
                
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                            Nouveau mot de passe
                        </label>
                        <input type="password" name="password" class="form-control form-control-sm rounded-3"
                               placeholder="••••••••">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                            Confirmer le mot de passe
                        </label>
                        <input type="password" name="password_confirmation" class="form-control form-control-sm rounded-3"
                               placeholder="••••••••">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold"
                                style="background:var(--primary); color:white;">
                            <i class="bi bi-shield-lock me-1"></i> Mettre à jour le mot de passe
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection