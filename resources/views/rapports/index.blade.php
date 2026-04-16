@extends('layouts.app')

@section('title', 'Rapports PDF/Excel')
@section('page-title', 'Rapports')
@section('page-subtitle', 'Génération et téléchargement des rapports statistiques')

@section('content')

@php
    use App\Models\Declaration;
    use App\Models\UniteIndustrielle;
    
    $annees = Declaration::select('annee')->distinct()->orderBy('annee', 'desc')->pluck('annee');
    $filieres = UniteIndustrielle::select('filiere')->whereNotNull('filiere')->distinct()->pluck('filiere');
    $departements = UniteIndustrielle::select('departement')->whereNotNull('departement')->distinct()->pluck('departement');
@endphp

<div class="row g-4 mb-4">

    <!-- Rapport PDF -->
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center"
                     style="width:50px; height:50px; background:#fee2e2;">
                    <i class="bi bi-file-earmark-pdf" style="font-size:1.8rem; color:#dc2626;"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0" style="color:var(--primary)">Rapport PDF</h6>
                    <small class="text-muted">Rapport complet de production</small>
                </div>
            </div>

            <form action="{{ route('rapports.pdf') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Année</label>
                    <select name="annee" class="form-select form-select-sm rounded-3" required>
                        <option value="">Sélectionner une année</option>
                        @foreach($annees as $a)
                            <option value="{{ $a }}">{{ $a }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Trimestre</label>
                    <select name="trimestre" class="form-select form-select-sm rounded-3" required>
                        <option value="">Sélectionner un trimestre</option>
                        <option value="1">T1 (Jan - Mar)</option>
                        <option value="2">T2 (Avr - Jun)</option>
                        <option value="3">T3 (Jul - Sep)</option>
                        <option value="4">T4 (Oct - Déc)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                    <select name="filiere" class="form-select form-select-sm rounded-3">
                        <option value="">Toutes les filières</option>
                        @foreach($filieres as $f)
                            <option value="{{ $f }}">{{ $f }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn rounded-3 fw-semibold w-100"
                        style="background:#dc2626; color:white;">
                    <i class="bi bi-file-earmark-pdf me-2"></i> Générer le PDF
                </button>
            </form>
        </div>
    </div>

    <!-- Rapport Excel -->
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center"
                     style="width:50px; height:50px; background:#dcfce7;">
                    <i class="bi bi-file-earmark-excel" style="font-size:1.8rem; color:#16a34a;"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0" style="color:var(--primary)">Rapport Excel</h6>
                    <small class="text-muted">Export des données brutes</small>
                </div>
            </div>

            <form action="{{ route('rapports.excel') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Année</label>
                    <select name="annee" class="form-select form-select-sm rounded-3" required>
                        <option value="">Sélectionner une année</option>
                        @foreach($annees as $a)
                            <option value="{{ $a }}">{{ $a }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                    <select name="departement" class="form-select form-select-sm rounded-3">
                        <option value="">Tous les départements</option>
                        @foreach($departements as $d)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Statut</label>
                    <select name="statut" class="form-select form-select-sm rounded-3">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente">En attente</option>
                        <option value="validee">Validée</option>
                        <option value="rejetee">Rejetée</option>
                    </select>
                </div>

                <button type="submit" class="btn rounded-3 fw-semibold w-100"
                        style="background:#16a34a; color:white;">
                    <i class="bi bi-file-earmark-excel me-2"></i> Générer l'Excel
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Historique des rapports générés -->
<div class="card p-4">
    <h6 class="fw-bold mb-3" style="color:var(--primary)">
        <i class="bi bi-clock-history me-2" style="color:var(--secondary)"></i>
        Derniers rapports générés
    </h6>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead style="background:#f0f4f8;">
                <tr>
                    <th style="font-size:13px;">Période</th>
                    <th style="font-size:13px;">Type</th>
                    <th style="font-size:13px;">Filière/Dept</th>
                    <th style="font-size:13px;">Généré le</th>
                    <th style="font-size:13px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rapportsRecents = \App\Models\Declaration::select('annee', 'trimestre')
                        ->distinct()
                        ->orderBy('annee', 'desc')
                        ->orderBy('trimestre', 'desc')
                        ->limit(5)
                        ->get();
                @endphp

                @forelse($rapportsRecents as $r)
                <tr>
                    <td class="fw-semibold" style="font-size:14px;">T{{ $r->trimestre }} - {{ $r->annee }}</td>
                    <td>
                        <span class="badge rounded-pill" style="background:#fee2e2; color:#dc2626;">
                            <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                        </span>
                    </td>
                    <td style="font-size:13px;">Toutes filières</td>
                    <td style="font-size:13px; color:gray;">{{ $r->created_at ? $r->created_at->format('d/m/Y') : 'Date inconnue' }}</td>
                    <td>
                        <button class="btn btn-sm rounded-2"
                                style="background:#e0f0ff; color:var(--primary);"
                                onclick="alert('Fonctionnalité en développement')">
                            <i class="bi bi-download me-1"></i> Télécharger
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun rapport généré pour le moment</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection