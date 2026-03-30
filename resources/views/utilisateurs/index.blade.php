@extends('layouts.app')

@section('title', 'Utilisateurs')
@section('page-title', 'Utilisateurs')
@section('page-subtitle', 'Gestion des comptes et des rôles utilisateurs')

@section('content')

    <!-- Stats rapides -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Total utilisateurs</p>
                        <h3 class="fw-bold mb-0">128</h3>
                    </div>
                    <i class="bi bi-people" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card orange">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Industriels</p>
                        <h3 class="fw-bold mb-0">95</h3>
                    </div>
                    <i class="bi bi-building" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card pink">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Agents</p>
                        <h3 class="fw-bold mb-0">28</h3>
                    </div>
                    <i class="bi bi-person-badge" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card dark">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Admins</p>
                        <h3 class="fw-bold mb-0">5</h3>
                    </div>
                    <i class="bi bi-shield-check" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color:var(--primary)">
                <i class="bi bi-people me-2" style="color:var(--secondary)"></i>
                Liste des utilisateurs
            </h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm rounded-3"
                       placeholder="🔍 Rechercher..." style="width:200px;">
                <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;">
                    <i class="bi bi-plus-lg me-1"></i> Ajouter
                </button>
            </div>
        </div>

        <!-- Filtres rôles -->
        <div class="d-flex gap-2 mb-3">
            <button class="btn btn-sm rounded-pill active"
                    style="background:var(--primary); color:white; font-size:12px;">
                Tous (128)
            </button>
            <button class="btn btn-sm rounded-pill"
                    style="background:#e0f0ff; color:var(--primary); font-size:12px;">
                Industriels (95)
            </button>
            <button class="btn btn-sm rounded-pill"
                    style="background:#fef3c7; color:#92400e; font-size:12px;">
                Agents (28)
            </button>
            <button class="btn btn-sm rounded-pill"
                    style="background:#fee2e2; color:#dc2626; font-size:12px;">
                Admins (5)
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f0f4f8;">
                    <tr>
                        <th style="font-size:13px;">#</th>
                        <th style="font-size:13px;">Utilisateur</th>
                        <th style="font-size:13px;">Email</th>
                        <th style="font-size:13px;">Rôle</th>
                        <th style="font-size:13px;">Unité / Service</th>
                        <th style="font-size:13px;">Dernière connexion</th>
                        <th style="font-size:13px;">Statut</th>
                        <th style="font-size:13px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $users = [
                            ['id'=>1, 'nom'=>'Jean KOFFI', 'email'=>'j.koffi@sobebra.bj', 'role'=>'Industriel', 'unite'=>'SOBEBRA', 'connexion'=>'Aujourd\'hui 09:30', 'statut'=>'Actif'],
                            ['id'=>2, 'nom'=>'Marie HOUN', 'email'=>'m.houn@ministere.bj', 'role'=>'Agent', 'unite'=>'Ministère Industrie', 'connexion'=>'Hier 14:20', 'statut'=>'Actif'],
                            ['id'=>3, 'nom'=>'Paul AGBO', 'email'=>'p.agbo@beniciment.bj', 'role'=>'Industriel', 'unite'=>'BÉNIN CIMENT', 'connexion'=>'25/03/2025', 'statut'=>'Inactif'],
                            ['id'=>4, 'nom'=>'Awa SABI', 'email'=>'a.sabi@ministere.bj', 'role'=>'Admin', 'unite'=>'Ministère Industrie', 'connexion'=>'Aujourd\'hui 08:00', 'statut'=>'Actif'],
                            ['id'=>5, 'nom'=>'Félix DOSSA', 'email'=>'f.dossa@saph.bj', 'role'=>'Industriel', 'unite'=>'SAPH BÉNIN', 'connexion'=>'Hier 11:45', 'statut'=>'Actif'],
                        ];
                    @endphp

                    @foreach($users as $u)
                    <tr>
                        <td style="font-size:13px; color:gray;">#{{ $u['id'] }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                     style="width:36px; height:36px; background:var(--primary); color:white; font-size:13px;">
                                    {{ strtoupper(substr($u['nom'], 0, 1)) }}
                                </div>
                                <div class="fw-semibold" style="font-size:14px;">{{ $u['nom'] }}</div>
                            </div>
                        </td>
                        <td style="font-size:13px;">{{ $u['email'] }}</td>
                        <td>
                            @if($u['role'] === 'Admin')
                                <span class="badge rounded-pill" style="background:#fee2e2; color:#dc2626;">
                                    <i class="bi bi-shield-check me-1"></i>Admin
                                </span>
                            @elseif($u['role'] === 'Agent')
                                <span class="badge rounded-pill" style="background:#fef3c7; color:#92400e;">
                                    <i class="bi bi-person-badge me-1"></i>Agent
                                </span>
                            @else
                                <span class="badge rounded-pill" style="background:#e0f0ff; color:var(--primary);">
                                    <i class="bi bi-building me-1"></i>Industriel
                                </span>
                            @endif
                        </td>
                        <td style="font-size:13px;">{{ $u['unite'] }}</td>
                        <td style="font-size:13px; color:gray;">{{ $u['connexion'] }}</td>
                        <td>
                            @if($u['statut'] === 'Actif')
                                <span class="badge rounded-pill bg-success">● Actif</span>
                            @else
                                <span class="badge rounded-pill bg-secondary">● Inactif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm rounded-2"
                                        style="background:#e0f0ff; color:var(--primary); font-size:12px;"
                                        title="Voir profil">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fef9c3; color:#854d0e; font-size:12px;"
                                        title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fee2e2; color:#dc2626; font-size:12px;"
                                        title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Affichage de 1 à 5 sur 128 utilisateurs</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link rounded-2" href="#">‹</a></li>
                    <li class="page-item active">
                        <a class="page-link rounded-2" href="#"
                           style="background:var(--primary); border-color:var(--primary);">1</a>
                    </li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">2</a></li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">3</a></li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">›</a></li>
                </ul>
            </nav>
        </div>
    </div>

@endsection