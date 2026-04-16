@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Vue générale de la production industrielle')

@section('content')

@php
    use App\Models\Declaration;
    use App\Models\UniteIndustrielle;
    use App\Models\AlerteMP;
    
    // Statistiques réelles
    $totalDeclarations = Declaration::count();
    $totalUnites = UniteIndustrielle::count();
    $totalAlertes = AlerteMP::where('est_traitee', false)->count();
    $totalRapports = 0; // À calculer si vous avez une table de rapports
    
    // Dernières déclarations
    $dernieresDeclarations = Declaration::with('uniteIndustrielle')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
    
    // Alertes par statut pour le graphique
    $alertesDisponible = AlerteMP::where('statut', 'disponible')->count();
    $alertesTension = AlerteMP::where('statut', 'tension')->count();
    $alertesRupture = AlerteMP::where('statut', 'rupture')->count();
    
    // Production par filière (exemple avec les unités)
    $filieres = UniteIndustrielle::select('filiere')
        ->whereNotNull('filiere')
        ->distinct()
        ->pluck('filiere')
        ->toArray();
    
    // Données pour le graphique (à adapter selon votre structure)
    $productionData = [];
    foreach($filieres as $filiere) {
        $productionData[] = UniteIndustrielle::where('filiere', $filiere)->count();
    }
@endphp

<!-- Cartes statistiques -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card blue">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Déclarations reçues</p>
                    <h3 class="fw-bold mb-0">{{ $totalDeclarations }}</h3>
                    <small style="opacity:0.7">Total général</small>
                </div>
                <i class="bi bi-file-earmark-text" style="font-size: 2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card orange">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Unités industrielles</p>
                    <h3 class="fw-bold mb-0">{{ $totalUnites }}</h3>
                    <small style="opacity:0.7">Enregistrées</small>
                </div>
                <i class="bi bi-buildings" style="font-size: 2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card pink">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Alertes actives</p>
                    <h3 class="fw-bold mb-0">{{ $totalAlertes }}</h3>
                    <small style="opacity:0.7">Tension / Rupture</small>
                </div>
                <i class="bi bi-exclamation-triangle" style="font-size: 2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Départements</p>
                    <h3 class="fw-bold mb-0">{{ $unitesParDept = UniteIndustrielle::distinct('departement')->count('departement') }}</h3>
                    <small style="opacity:0.7">Couverts</small>
                </div>
                <i class="bi bi-geo-alt" style="font-size: 2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>
</div>

<!-- Graphiques -->
<div class="row g-4 mb-4">
    <div class="col-md-8">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="color: var(--primary)">
                <i class="bi bi-bar-chart me-2" style="color: var(--secondary)"></i>
                Unités par filière
            </h6>
            <canvas id="productionChart" height="120"></canvas>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="color: var(--primary)">
                <i class="bi bi-pie-chart me-2" style="color: var(--accent)"></i>
                État des matières premières
            </h6>
            <canvas id="matiereChart" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Dernières déclarations -->
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0" style="color: var(--primary)">
            <i class="bi bi-clock-history me-2" style="color: var(--secondary)"></i>
            Dernières déclarations
        </h6>
        <a href="{{ route('declarations.index') }}" class="btn btn-sm" style="background: var(--primary); color: white; border-radius: 8px;">
            Voir tout
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead style="background: #f0f4f8;">
                <tr>
                    <th>Industriel</th>
                    <th>Filière</th>
                    <th>Département</th>
                    <th>Date</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dernieresDeclarations as $d)
                <tr>
                    <td><strong>{{ $d->uniteIndustrielle->nom ?? 'N/A' }}</strong></td>
                    <td>{{ $d->uniteIndustrielle->filiere ?? 'N/A' }}</td>
                    <td>{{ $d->uniteIndustrielle->departement ?? 'N/A' }}</td>
                    <td>{{ $d->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if($d->statut === 'validee')
                            <span class="badge bg-success">Validée</span>
                        @elseif($d->statut === 'en_attente')
                            <span class="badge bg-warning text-dark">En attente</span>
                        @else
                            <span class="badge bg-danger">Rejetée</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune déclaration pour le moment</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique barres - Unités par filière
    const filieres = @json($filieres);
    const productionData = @json($productionData);
    
    new Chart(document.getElementById('productionChart'), {
        type: 'bar',
        data: {
            labels: filieres,
            datasets: [{
                label: "Nombre d'unités",
                data: productionData,
                backgroundColor: '#1e3a5f',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, title: { display: true, text: 'Nombre d\'unités' } } }
        }
    });

    // Graphique doughnut - Matières premières
    new Chart(document.getElementById('matiereChart'), {
        type: 'doughnut',
        data: {
            labels: ['Disponible', 'Tension', 'Rupture'],
            datasets: [{
                data: [{{ $alertesDisponible }}, {{ $alertesTension }}, {{ $alertesRupture }}],
                backgroundColor: ['#1e3a5f', '#f97316', '#dc2626'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } },
            cutout: '70%'
        }
    });
</script>
@endpush