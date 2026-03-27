@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Vue générale de la production industrielle')

@section('content')

    <!-- Cartes statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Déclarations reçues</p>
                        <h3 class="fw-bold mb-0">1 248</h3>
                        <small style="opacity:0.7">Ce trimestre</small>
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
                        <h3 class="fw-bold mb-0">342</h3>
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
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Alertes matières</p>
                        <h3 class="fw-bold mb-0">17</h3>
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
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Rapports générés</p>
                        <h3 class="fw-bold mb-0">89</h3>
                        <small style="opacity:0.7">Ce mois</small>
                    </div>
                    <i class="bi bi-file-earmark-pdf" style="font-size: 2.5rem; opacity:0.4"></i>
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
                    Production par filière (12 derniers mois)
                </h6>
                <canvas id="productionChart" height="120"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4">
                <h6 class="fw-bold mb-3" style="color: var(--primary)">
                    <i class="bi bi-pie-chart me-2" style="color: var(--accent)"></i>
                    Matières premières
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
            <a href="#" class="btn btn-sm" style="background: var(--primary); color: white; border-radius: 8px;">
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
                    <tr>
                        <td><strong>SOBEBRA</strong></td>
                        <td>Agro-alimentaire</td>
                        <td>Littoral</td>
                        <td>25/03/2025</td>
                        <td><span class="badge bg-success">Validée</span></td>
                    </tr>
                    <tr>
                        <td><strong>COTONOU TEXTILE</strong></td>
                        <td>Textile</td>
                        <td>Atlantique</td>
                        <td>24/03/2025</td>
                        <td><span class="badge bg-warning text-dark">En attente</span></td>
                    </tr>
                    <tr>
                        <td><strong>BÉNIN CIMENT</strong></td>
                        <td>BTP</td>
                        <td>Ouémé</td>
                        <td>23/03/2025</td>
                        <td><span class="badge bg-danger">Rejetée</span></td>
                    </tr>
                    <tr>
                        <td><strong>AGRO BÉNIN</strong></td>
                        <td>Agriculture</td>
                        <td>Zou</td>
                        <td>22/03/2025</td>
                        <td><span class="badge bg-success">Validée</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique barres - Production
    new Chart(document.getElementById('productionChart'), {
        type: 'bar',
        data: {
            labels: ['Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc', 'Jan', 'Fév', 'Mar'],
            datasets: [
                {
                    label: 'Agro-alimentaire',
                    data: [120, 135, 140, 130, 125, 150, 160, 145, 170, 155, 165, 180],
                    backgroundColor: '#1a3a5c',
                    borderRadius: 6,
                },
                {
                    label: 'Textile',
                    data: [80, 90, 85, 95, 88, 100, 95, 110, 105, 115, 120, 130],
                    backgroundColor: '#f97316',
                    borderRadius: 6,
                },
                {
                    label: 'BTP',
                    data: [60, 65, 70, 68, 72, 75, 80, 78, 85, 82, 88, 92],
                    backgroundColor: '#f43f8e',
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Graphique doughnut - Matières premières
    new Chart(document.getElementById('matiereChart'), {
        type: 'doughnut',
        data: {
            labels: ['Disponible', 'Tension', 'Rupture'],
            datasets: [{
                data: [65, 25, 10],
                backgroundColor: ['#1a3a5c', '#f97316', '#f43f8e'],
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