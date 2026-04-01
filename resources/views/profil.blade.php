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
                    A
                </div>
            </div>
            <h5 class="fw-bold mb-0" style="color:var(--primary)">Awa SABI</h5>
            <p class="text-muted mb-2" style="font-size:13px;">a.sabi@ministere.bj</p>
            <span class="badge rounded-pill mb-3"
                  style="background:#fee2e2; color:#dc2626; font-size:12px;">
                <i class="bi bi-shield-check me-1"></i>Administrateur
            </span>

            <hr>

            <div class="text-start">
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Dernière connexion</small>
                    <small class="fw-semibold">Aujourd'hui 08:00</small>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Membre depuis</small>
                    <small class="fw-semibold">Jan 2024</small>
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

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Prénom</label>
                    <input type="text" class="form-control form-control-sm rounded-3" value="Awa">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom</label>
                    <input type="text" class="form-control form-control-sm rounded-3" value="SABI">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Email</label>
                    <input type="email" class="form-control form-control-sm rounded-3" value="a.sabi@ministere.bj">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Téléphone</label>
                    <input type="text" class="form-control form-control-sm rounded-3" value="+229 01 97 00 00 00">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Rôle</label>
                    <input type="text" class="form-control form-control-sm rounded-3" value="Administrateur" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Service</label>
                    <input type="text" class="form-control form-control-sm rounded-3" value="Ministère de l'Industrie">
                </div>
                <div class="col-12">
                    <button class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--secondary); color:white;">
                        <i class="bi bi-save me-1"></i> Enregistrer les modifications
                    </button>
                </div>
            </div>
        </div>

        <!-- Changer mot de passe -->
        <div class="card p-4">
            <h6 class="fw-bold mb-4" style="color:var(--primary)">
                <i class="bi bi-lock me-2" style="color:var(--accent)"></i>
                Changer le mot de passe
            </h6>

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                        Mot de passe actuel
                    </label>
                    <input type="password" class="form-control form-control-sm rounded-3"
                           placeholder="••••••••">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                        Nouveau mot de passe
                    </label>
                    <input type="password" class="form-control form-control-sm rounded-3"
                           placeholder="••••••••">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                        Confirmer le mot de passe
                    </label>
                    <input type="password" class="form-control form-control-sm rounded-3"
                           placeholder="••••••••">
                </div>
                <div class="col-12">
                    <button class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--primary); color:white;">
                        <i class="bi bi-shield-lock me-1"></i> Mettre à jour le mot de passe
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection