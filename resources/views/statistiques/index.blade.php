 @extends('layouts.app')

@section('title', 'Statistiques')
@section('page-title', 'Statistiques')
@section('page-subtitle', 'Analyse et visualisation des données de production industrielle')

@section('content')

@php
    use App\Models\Declaration;
    use App\Models\UniteIndustrielle;
    use App\Models\VenteDetail;
    use App\Models\ConsommationMPDetail;
    
    // Années disponibles
    $annees = Declaration::select('annee')->distinct()->orderBy('annee', 'desc')->pluck('annee');
    $anneeActuelle = $annees->first() ?? date('Y');
    
    // Filières et départements pour les filtres
    $filieres = UniteIndustrielle::select('filiere')->whereNotNull('filiere')->distinct()->pluck('filiere');
    $departements = UniteIndustrielle::select('departement')->whereNotNull('departement')->distinct()->pluck('departement');
    
    // Statistiques de base
    $declarationsValidees = Declaration::where('statut', 'validee');
    
    $productionTotale = \App\Models\ProductionDetail::sum('quantite_produite');
    $caTotal = VenteDetail::sum('chiffre_affaires');
    $exportTotal = VenteDetail::where('marche', 'export')->sum('quantite_vendue');
    
    $consommationLocale = ConsommationMPDetail::whereHas('matierePremiere', function($q) {
        $q->where('origine', 'locale');
    })->sum('quantite_utilisee');
    
    $consommationImportee = ConsommationMPDetail::whereHas('matierePremiere', function($q) {
        $q->where('origine', 'importee');
    })->sum('quantite_utilisee');
    
    $ratioLocal = $consommationLocale + $consommationImportee > 0 
        ? round(($consommationLocale / ($consommationLocale + $consommationImportee)) * 100) 
        : 0;
    
    // Production par filière (pour le graphique en barres)
    $productionParFiliere = [];
    foreach($filieres as $filiere) {
        $uniteIds = UniteIndustrielle::where('filiere', $filiere)->pluck('id');
        $productionParFiliere[$filiere] = \App\Models\ProductionDetail::whereHas('declaration', function($q) use ($uniteIds) {
            $q->whereIn('unite_industrielle_id', $uniteIds)->where('statut', 'validee');
        })->sum('quantite_produite');
    }
    
    // Répartition par filière (pour le doughnut)
    $repartitionData = array_values($productionParFiliere);
    $repartitionLabels = array_keys($productionParFiliere);
    $repartitionColors = ['#1e3a5f', '#f97316', '#dc2626', '#16a34a', '#8b5cf6', '#f59e0b'];
    
    // Production par département
    $productionParDept = [];
    foreach($departements as $dept) {
        $uniteIds = UniteIndustrielle::where('departement', $dept)->pluck('id');
        $productionParDept[$dept] = \App\Models\ProductionDetail::whereHas('declaration', function($q) use ($uniteIds) {
            $q->whereIn('unite_industrielle_id', $uniteIds)->where('statut', 'validee');
        })->sum('quantite_produite');
    }
    
    // Données mensuelles pour l'évolution
    $mois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
    $productionMensuelle = [];
    foreach($filieres as $filiere) {
        $uniteIds = UniteIndustrielle::where('filiere', $filiere)->pluck('id');
        $data = [];
        for($m = 1; $m <= 12; $m++) {
            $total = \App\Models\ProductionDetail::whereHas('declaration', function($q) use ($uniteIds, $m, $anneeActuelle) {
                $q->whereIn('unite_industrielle_id', $uniteIds)
                  ->where('statut', 'validee')
                  ->where('annee', $anneeActuelle)
                  ->where('trimestre', ceil($m/3));
            })->sum('quantite_produite');
            $data[] = round($total, 0);
        }
        $productionMensuelle[$filiere] = $data;
    }
    
    // Ratio MP locale vs importée par mois
    $ratioLocalMensuel = [];
    $ratioImporteMensuel = [];
    for($m = 1; $m <= 12; $m++) {
        $trimestre = ceil($m/3);
        $local = ConsommationMPDetail::whereHas('declaration', function($q) use ($trimestre, $anneeActuelle) {
            $q->where('trimestre', $trimestre)->where('annee', $anneeActuelle)->where('statut', 'validee');
        })->whereHas('matierePremiere', function($q) {
            $q->where('origine', 'locale');
        })->sum('quantite_utilisee');
        
        $importe = ConsommationMPDetail::whereHas('declaration', function($q) use ($trimestre, $anneeActuelle) {
            $q->where('trimestre', $trimestre)->where('annee', $anneeActuelle)->where('statut', 'validee');
        })->whereHas('matierePremiere', function($q) {
            $q->where('origine', 'importee');
        })->sum('quantite_utilisee');
        
        $total = $local + $importe;
        $ratioLocalMensuel[] = $total > 0 ? round(($local / $total) * 100) : 0;
        $ratioImporteMensuel[] = $total > 0 ? round(($importe / $total) * 100) : 0;
    }
@endphp

<!-- Filtres période -->
<div class="card p-4 mb-4">
    <form method="GET" action="{{ route('statistiques.index') }}" id="filterForm">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Année</label>
                <select class="form-select form-select-sm rounded-3" name="annee" id="anneeSelect">
                    @foreach($annees as $a)
                        <option value="{{ $a }}" {{ request('annee', $anneeActuelle) == $a ? 'selected' : '' }}>{{ $a }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                <select class="form-select form-select-sm rounded-3" name="filiere" id="filiereSelect">
                    <option value="">Toutes les filières</option>
                    @foreach($filieres as $f)
                        <option value="{{ $f }}" {{ request('filiere') == $f ? 'selected' : '' }}>{{ $f }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                <select class="form-select form-select-sm rounded-3" name="departement" id="departementSelect">
                    <option value="">Tous les départements</option>
                    @foreach($departements as $d)
                        <option value="{{ $d }}" {{ request('departement') == $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm w-100 rounded-3" style="background:var(--primary); color:white;">
                    <i class="bi bi-bar-chart me-1"></i> Actualiser
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Stats KPI -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card blue">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Production totale</p>
                    <h3 class="fw-bold mb-0">{{ number_format($productionTotale, 0) }} T</h3>
                    <small style="opacity:0.7">Toutes filières</small>
                </div>
                <i class="bi bi-graph-up" style="font-size:2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card orange">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Chiffre d'affaires</p>
                    <h3 class="fw-bold mb-0">{{ number_format($caTotal / 1000000, 1) }} Mds FCFA</h3>
                    <small style="opacity:0.7">Total déclarations</small>
                </div>
                <i class="bi bi-currency-dollar" style="font-size:2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card pink">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Exportations</p>
                    <h3 class="fw-bold mb-0">{{ number_format($exportTotal, 0) }} T</h3>
                    <small style="opacity:0.7">Total exporté</small>
                </div>
                <i class="bi bi-airplane" style="font-size:2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">MP locale utilisée</p>
                    <h3 class="fw-bold mb-0">{{ $ratioLocal }}%</h3>
                    <small style="opacity:0.7">Ratio d'utilisation</small>
                </div>
                <i class="bi bi-pie-chart" style="font-size:2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>
</div>

<!-- Graphiques ligne 1 -->
<div class="row g-4 mb-4">
    <div class="col-md-8">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="color:var(--primary)">
                <i class="bi bi-bar-chart me-2" style="color:var(--secondary)"></i>
                Production par filière (12 mois)
            </h6>
            <canvas id="productionFiliereChart" height="120"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="color:var(--primary)">
                <i class="bi bi-pie-chart me-2" style="color:var(--accent)"></i>
                Répartition par filière
            </h6>
            <canvas id="repartitionChart" height="220"></canvas>
        </div>
    </div>
</div>

<!-- Graphiques ligne 2 -->
<div class="row g-4">
    <div class="col-md-6">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="color:var(--primary)">
                <i class="bi bi-geo-alt me-2" style="color:var(--secondary)"></i>
                Production par département
            </h6>
            <canvas id="departementChart" height="180"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="color:var(--primary)">
                <i class="bi bi-arrow-left-right me-2" style="color:var(--accent)"></i>
                Ratio MP locale vs importée
            </h6>
            <canvas id="ratioMPChart" height="180"></canvas>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Données PHP vers JavaScript
    const filieres = @json(array_keys($productionMensuelle));
    const productionMensuelle = @json($productionMensuelle);
    const mois = @json($mois);
    const repartitionLabels = @json($repartitionLabels);
    const repartitionData = @json($repartitionData);
    const deptLabels = @json(array_keys($productionParDept));
    const deptData = @json(array_values($productionParDept));
    const ratioLocal = @json($ratioLocalMensuel);
    const ratioImporte = @json($ratioImporteMensuel);
    
    // Couleurs
    const couleurs = ['#1e3a5f', '#f97316', '#dc2626', '#16a34a', '#8b5cf6', '#f59e0b'];
    
    // Production par filière (graphique en lignes)
    const datasets = [];
    filieres.forEach((filiere, index) => {
        datasets.push({
            label: filiere,
            data: productionMensuelle[filiere] || Array(12).fill(0),
            borderColor: couleurs[index % couleurs.length],
            backgroundColor: 'rgba(30,58,95,0.1)',
            tension: 0.4,
            fill: true,
        });
    });
    
    new Chart(document.getElementById('productionFiliereChart'), {
        type: 'line',
        data: { labels: mois, datasets: datasets },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, title: { display: true, text: 'Production (Tonnes)' } } }
        }
    });
    
    // Répartition par filière (doughnut)
    new Chart(document.getElementById('repartitionChart'), {
        type: 'doughnut',
        data: {
            labels: repartitionLabels,
            datasets: [{
                data: repartitionData,
                backgroundColor: couleurs,
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } },
            cutout: '65%'
        }
    });
    
    // Production par département
    new Chart(document.getElementById('departementChart'), {
        type: 'bar',
        data: {
            labels: deptLabels,
            datasets: [{
                label: 'Production (Tonnes)',
                data: deptData,
                backgroundColor: '#1e3a5f',
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, title: { display: true, text: 'Tonnes' } } }
        }
    });
    
    // Ratio MP locale vs importée
    new Chart(document.getElementById('ratioMPChart'), {
        type: 'bar',
        data: {
            labels: mois,
            datasets: [
                {
                    label: 'MP Locale (%)',
                    data: ratioLocal,
                    backgroundColor: '#1e3a5f',
                    borderRadius: 6,
                },
                {
                    label: 'MP Importée (%)',
                    data: ratioImporte,
                    backgroundColor: '#f97316',
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { 
                y: { beginAtZero: true, max: 100, stacked: true, title: { display: true, text: 'Pourcentage (%)' } },
                x: { stacked: true }
            }
        }
    });
</script>
@endpush