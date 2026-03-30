@extends('layouts.app')

@section('title', 'Statistiques')
@section('page-title', 'Statistiques')
@section('page-subtitle', 'Analyse et visualisation des données de production industrielle')

@section('content')

    <!-- Filtres période -->
    <div class="card p-4 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Année</label>
                <select class="form-select form-select-sm rounded-3">
                    <option>2025</option>
                    <option>2024</option>
                    <option>2023</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                <select class="form-select form-select-sm rounded-3">
                    <option>Toutes les filières</option>
                    <option>Agro-alimentaire</option>
                    <option>Textile</option>
                    <option>BTP</option>
                    <option>Agriculture</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                <select class="form-select form-select-sm rounded-3">
                    <option>Tous les départements</option>
                    <option>Littoral</option>
                    <option>Atlantique</option>
                    <option>Ouémé</option>
                    <option>Borgou</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-sm w-100 rounded-3" style="background:var(--primary); color:white;">
                    <i class="bi bi-bar-chart me-1"></i> Actualiser
                </button>
            </div>
        </div>
    </div>

    <!-- Stats KPI -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Production totale</p>
                        <h3 class="fw-bold mb-0">48 250 T</h3>
                        <small style="opacity:0.7">↑ +12% vs 2024</small>
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
                        <h3 class="fw-bold mb-0">12,4 Mds FCFA</h3>
                        <small style="opacity:0.7">↑ +8% vs 2024</small>
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
                        <h3 class="fw-bold mb-0">18 300 T</h3>
                        <small style="opacity:0.7">↑ +15% vs 2024</small>
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
                        <h3 class="fw-bold mb-0">65%</h3>
                        <small style="opacity:0.7">↑ +5% vs 2024</small>
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
    // Production par filière
    new Chart(document.getElementById('productionFiliereChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [
                {
                    label: 'Agro-alimentaire',
                    data: [120, 135, 140, 130, 125, 150, 160, 145, 170, 155, 165, 180],
                    borderColor: '#1a3a5c',
                    backgroundColor: 'rgba(26,58,92,0.1)',
                    tension: 0.4, fill: true,
                },
                {
                    label: 'Textile',
                    data: [80, 90, 85, 95, 88, 100, 95, 110, 105, 115, 120, 130],
                    borderColor: '#f97316',
                    backgroundColor: 'rgba(249,115,22,0.1)',
                    tension: 0.4, fill: true,
                },
                {
                    label: 'BTP',
                    data: [60, 65, 70, 68, 72, 75, 80, 78, 85, 82, 88, 92],
                    borderColor: '#f43f8e',
                    backgroundColor: 'rgba(244,63,142,0.1)',
                    tension: 0.4, fill: true,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Répartition par filière
    new Chart(document.getElementById('repartitionChart'), {
        type: 'doughnut',
        data: {
            labels: ['Agro-alimentaire', 'Textile', 'BTP', 'Agriculture'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: ['#1a3a5c', '#f97316', '#f43f8e', '#111827'],
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
            labels: ['Littoral', 'Atlantique', 'Ouémé', 'Borgou', 'Zou', 'Atacora'],
            datasets: [{
                label: 'Production (Tonnes)',
                data: [1800, 1400, 1100, 900, 750, 500],
                backgroundColor: ['#1a3a5c', '#f97316', '#f43f8e', '#111827', '#2563eb', '#f43f8e'],
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Ratio MP locale vs importée
    new Chart(document.getElementById('ratioMPChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [
                {
                    label: 'MP Locale',
                    data: [65, 62, 68, 70, 66, 72, 75, 71, 74, 76, 73, 78],
                    backgroundColor: '#1a3a5c',
                    borderRadius: 6,
                },
                {
                    label: 'MP Importée',
                    data: [35, 38, 32, 30, 34, 28, 25, 29, 26, 24, 27, 22],
                    backgroundColor: '#f97316',
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, stacked: true }, x: { stacked: true } }
        }
    });
</script>
@endpush