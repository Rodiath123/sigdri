@extends('layouts.app')

@section('title', 'Déclarations')
@section('page-title', 'Déclarations')
@section('page-subtitle', 'Gestion et validation des déclarations industrielles')

@section('content')

    <!-- Filtres -->
    <div class="card p-4 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Statut</label>
                <select class="form-select form-select-sm rounded-3">
                    <option value="">Tous les statuts</option>
                    <option>Validée</option>
                    <option>En attente</option>
                    <option>Rejetée</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                <select class="form-select form-select-sm rounded-3">
                    <option value="">Toutes les filières</option>
                    <option>Agro-alimentaire</option>
                    <option>Textile</option>
                    <option>BTP</option>
                    <option>Agriculture</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                <select class="form-select form-select-sm rounded-3">
                    <option value="">Tous les départements</option>
                    <option>Littoral</option>
                    <option>Atlantique</option>
                    <option>Ouémé</option>
                    <option>Zou</option>
                    <option>Borgou</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-sm w-100 rounded-3" style="background:var(--primary); color:white;">
                    <i class="bi bi-funnel me-1"></i> Filtrer
                </button>
            </div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color:var(--primary)">
                <i class="bi bi-file-earmark-text me-2" style="color:var(--secondary)"></i>
                Liste des déclarations
            </h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm rounded-3"
                       placeholder="🔍 Rechercher..." style="width:200px;">
                <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;">
                    <i class="bi bi-download me-1"></i> Exporter
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f0f4f8;">
                    <tr>
                        <th style="font-size:13px;">#</th>
                        <th style="font-size:13px;">Industriel</th>
                        <th style="font-size:13px;">Filière</th>
                        <th style="font-size:13px;">Département</th>
                        <th style="font-size:13px;">Trimestre</th>
                        <th style="font-size:13px;">Date soumission</th>
                        <th style="font-size:13px;">Statut</th>
                        <th style="font-size:13px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $declarations = [
                            ['id'=>1, 'industriel'=>'SOBEBRA', 'filiere'=>'Agro-alimentaire', 'dept'=>'Littoral', 'trimestre'=>'T1 2025', 'date'=>'25/03/2025', 'statut'=>'Validée'],
                            ['id'=>2, 'industriel'=>'COTONOU TEXTILE', 'filiere'=>'Textile', 'dept'=>'Atlantique', 'trimestre'=>'T1 2025', 'date'=>'24/03/2025', 'statut'=>'En attente'],
                            ['id'=>3, 'industriel'=>'BÉNIN CIMENT', 'filiere'=>'BTP', 'dept'=>'Ouémé', 'trimestre'=>'T1 2025', 'date'=>'23/03/2025', 'statut'=>'Rejetée'],
                            ['id'=>4, 'industriel'=>'AGRO BÉNIN', 'filiere'=>'Agriculture', 'dept'=>'Zou', 'trimestre'=>'T1 2025', 'date'=>'22/03/2025', 'statut'=>'Validée'],
                            ['id'=>5, 'industriel'=>'SAPH BÉNIN', 'filiere'=>'Agro-alimentaire', 'dept'=>'Borgou', 'trimestre'=>'T1 2025', 'date'=>'21/03/2025', 'statut'=>'En attente'],
                            ['id'=>6, 'industriel'=>'TEXTILE NORD', 'filiere'=>'Textile', 'dept'=>'Atacora', 'trimestre'=>'T1 2025', 'date'=>'20/03/2025', 'statut'=>'En attente'],
                        ];
                    @endphp

                    @foreach($declarations as $d)
                    <tr>
                        <td style="font-size:13px; color:gray;">#{{ $d['id'] }}</td>
                        <td>
                            <div class="fw-semibold" style="font-size:14px;">{{ $d['industriel'] }}</div>
                        </td>
                        <td style="font-size:13px;">{{ $d['filiere'] }}</td>
                        <td style="font-size:13px;">{{ $d['dept'] }}</td>
                        <td style="font-size:13px;">{{ $d['trimestre'] }}</td>
                        <td style="font-size:13px;">{{ $d['date'] }}</td>
                        <td>
                            @if($d['statut'] === 'Validée')
                                <span class="badge rounded-pill bg-success">✓ Validée</span>
                            @elseif($d['statut'] === 'En attente')
                                <span class="badge rounded-pill bg-warning text-dark">⏳ En attente</span>
                            @else
                                <span class="badge rounded-pill bg-danger">✗ Rejetée</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm rounded-2"
                                        style="background:#e0f0ff; color:var(--primary); font-size:12px;"
                                        title="Voir détail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @if($d['statut'] === 'En attente')
                                <button class="btn btn-sm rounded-2"
                                        style="background:#dcfce7; color:#16a34a; font-size:12px;"
                                        title="Valider">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fee2e2; color:#dc2626; font-size:12px;"
                                        title="Rejeter">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Affichage de 1 à 6 sur 248 déclarations</small>
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