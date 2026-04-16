@extends('layouts.app')

@section('title', 'Paramétrage')
@section('page-title', 'Paramétrage')
@section('page-subtitle', 'Configuration des filières, départements et paramètres système')

@section('content')

@php
    use App\Models\UniteIndustrielle;
    use App\Models\User;
    
    // Filières dynamiques depuis les unités industrielles
    $filieres = UniteIndustrielle::select('filiere')
        ->whereNotNull('filiere')
        ->selectRaw('count(*) as total_unites')
        ->groupBy('filiere')
        ->get();
    
    // Départements dynamiques
    $departements = UniteIndustrielle::select('departement')
        ->whereNotNull('departement')
        ->selectRaw('count(*) as total_unites')
        ->groupBy('departement')
        ->get();
    
    // Statistiques
    $totalUnites = UniteIndustrielle::count();
    $totalUtilisateurs = User::count();
@endphp

<!-- Onglets -->
<div class="d-flex gap-2 mb-4">
    <button class="btn btn-sm rounded-3 fw-semibold" id="tab-filieres"
            style="background:var(--primary); color:white; font-size:13px;">
        <i class="bi bi-diagram-3 me-1"></i> Filières
    </button>
    <button class="btn btn-sm rounded-3 fw-semibold" id="tab-departements"
            style="background:#f0f4f8; color:var(--primary); font-size:13px;">
        <i class="bi bi-geo-alt me-1"></i> Départements
    </button>
    <button class="btn btn-sm rounded-3 fw-semibold" id="tab-systeme"
            style="background:#f0f4f8; color:var(--primary); font-size:13px;">
        <i class="bi bi-gear me-1"></i> Système
    </button>
</div>

<!-- Section Filières -->
<div id="section-filieres">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color:var(--primary)">
                <i class="bi bi-diagram-3 me-2" style="color:var(--secondary)"></i>
                Gestion des filières
            </h6>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f0f4f8;">
                    <tr>
                        <th style="font-size:13px;">#</th>
                        <th style="font-size:13px;">Nom de la filière</th>
                        <th style="font-size:13px;">Nb unités</th>
                        <th style="font-size:13px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($filieres as $index => $f)
                    <tr>
                        <td style="font-size:13px; color:gray;">{{ $loop->iteration }}</td>
                        <td class="fw-semibold" style="font-size:14px;">{{ $f->filiere }}</td>
                        <td style="font-size:13px;">{{ $f->total_unites }} unités</td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fee2e2; color:#dc2626; font-size:12px;"
                                        onclick="alert('Fonctionnalité en développement')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Aucune filière trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="alert alert-info mt-3 small">
            <i class="bi bi-info-circle me-1"></i>
            Les filières sont automatiquement extraites des unités industrielles enregistrées.
        </div>
    </div>
</div>

<!-- Section Départements -->
<div id="section-departements" style="display:none;">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color:var(--primary)">
                <i class="bi bi-geo-alt me-2" style="color:var(--secondary)"></i>
                Gestion des départements
            </h6>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f0f4f8;">
                    <tr>
                        <th style="font-size:13px;">#</th>
                        <th style="font-size:13px;">Département</th>
                        <th style="font-size:13px;">Nb unités</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departements as $index => $d)
                    <tr>
                        <td style="font-size:13px; color:gray;">{{ $loop->iteration }}</td>
                        <td class="fw-semibold" style="font-size:14px;">{{ $d->departement }}</td>
                        <td style="font-size:13px;">{{ $d->total_unites }} unités</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Aucun département trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="alert alert-info mt-3 small">
            <i class="bi bi-info-circle me-1"></i>
            Les départements sont automatiquement extraits des unités industrielles enregistrées.
        </div>
    </div>
</div>

<!-- Section Système -->
<div id="section-systeme" style="display:none;">
    <div class="card p-4">
        <h6 class="fw-bold mb-4" style="color:var(--primary)">
            <i class="bi bi-gear me-2" style="color:var(--secondary)"></i>
            Informations système
        </h6>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="border rounded-3 p-3">
                    <small class="text-muted">Total unités industrielles</small>
                    <h4 class="fw-bold mb-0" style="color:var(--primary)">{{ $totalUnites }}</h4>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded-3 p-3">
                    <small class="text-muted">Total utilisateurs</small>
                    <h4 class="fw-bold mb-0" style="color:var(--primary)">{{ $totalUtilisateurs }}</h4>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded-3 p-3">
                    <small class="text-muted">Version</small>
                    <h4 class="fw-bold mb-0" style="color:var(--primary)">SIGDRI v1.0</h4>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded-3 p-3">
                    <small class="text-muted">Dernière mise à jour</small>
                    <h4 class="fw-bold mb-0" style="color:var(--primary)">{{ now()->format('d/m/Y') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const tabs = ['filieres', 'departements', 'systeme'];

    tabs.forEach(tab => {
        document.getElementById('tab-' + tab).onclick = function() {
            tabs.forEach(t => {
                document.getElementById('section-' + t).style.display = 'none';
                document.getElementById('tab-' + t).style.background = '#f0f4f8';
                document.getElementById('tab-' + t).style.color = 'var(--primary)';
            });
            document.getElementById('section-' + tab).style.display = 'block';
            this.style.background = 'var(--primary)';
            this.style.color = 'white';
        };
    });
</script>
@endpush