@extends('layouts.app')

@section('title', 'Rapports PDF/Excel')
@section('page-title', 'Rapports')
@section('page-subtitle', 'Génération et téléchargement des rapports statistiques')

@section('content')

    <!-- Générateur de rapports -->
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

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Période</label>
                    <select class="form-select form-select-sm rounded-3">
                        <option>Trimestre 1 - 2025</option>
                        <option>Trimestre 2 - 2025</option>
                        <option>Trimestre 3 - 2025</option>
                        <option>Trimestre 4 - 2024</option>
                        <option>Année complète - 2024</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                    <select class="form-select form-select-sm rounded-3">
                        <option>Toutes les filières</option>
                        <option>Agro-alimentaire</option>
                        <option>Textile</option>
                        <option>BTP</option>
                        <option>Agriculture</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Contenu</label>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked id="chk1">
                            <label class="form-check-label" style="font-size:13px;" for="chk1">
                                Statistiques de production
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked id="chk2">
                            <label class="form-check-label" style="font-size:13px;" for="chk2">
                                Graphiques et visualisations
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked id="chk3">
                            <label class="form-check-label" style="font-size:13px;" for="chk3">
                                Données matières premières
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chk4">
                            <label class="form-check-label" style="font-size:13px;" for="chk4">
                                Liste des déclarations
                            </label>
                        </div>
                    </div>
                </div>

                <button class="btn rounded-3 fw-semibold"
                        style="background:#dc2626; color:white;">
                    <i class="bi bi-file-earmark-pdf me-2"></i> Générer le PDF
                </button>
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

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Période</label>
                    <select class="form-select form-select-sm rounded-3">
                        <option>Trimestre 1 - 2025</option>
                        <option>Trimestre 2 - 2025</option>
                        <option>Trimestre 3 - 2025</option>
                        <option>Trimestre 4 - 2024</option>
                        <option>Année complète - 2024</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                    <select class="form-select form-select-sm rounded-3">
                        <option>Tous les départements</option>
                        <option>Littoral</option>
                        <option>Atlantique</option>
                        <option>Ouémé</option>
                        <option>Borgou</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Données à exporter</label>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked id="chk5">
                            <label class="form-check-label" style="font-size:13px;" for="chk5">
                                Déclarations de production
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked id="chk6">
                            <label class="form-check-label" style="font-size:13px;" for="chk6">
                                Unités industrielles
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chk7">
                            <label class="form-check-label" style="font-size:13px;" for="chk7">
                                Matières premières
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chk8">
                            <label class="form-check-label" style="font-size:13px;" for="chk8">
                                Alertes et signalements
                            </label>
                        </div>
                    </div>
                </div>

                <button class="btn rounded-3 fw-semibold"
                        style="background:#16a34a; color:white;">
                    <i class="bi bi-file-earmark-excel me-2"></i> Générer l'Excel
                </button>
            </div>
        </div>
    </div>

    <!-- Historique des rapports -->
    <div class="card p-4">
        <h6 class="fw-bold mb-3" style="color:var(--primary)">
            <i class="bi bi-clock-history me-2" style="color:var(--secondary)"></i>
            Historique des rapports générés
        </h6>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f0f4f8;">
                    <tr>
                        <th style="font-size:13px;">Nom du rapport</th>
                        <th style="font-size:13px;">Type</th>
                        <th style="font-size:13px;">Période</th>
                        <th style="font-size:13px;">Généré par</th>
                        <th style="font-size:13px;">Date</th>
                        <th style="font-size:13px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rapports = [
                            ['nom'=>'Rapport production T1 2025', 'type'=>'PDF', 'periode'=>'T1 2025', 'par'=>'Awa SABI', 'date'=>'26/03/2025'],
                            ['nom'=>'Export déclarations Mars 2025', 'type'=>'Excel', 'periode'=>'Mars 2025', 'par'=>'Marie HOUN', 'date'=>'25/03/2025'],
                            ['nom'=>'Rapport annuel 2024', 'type'=>'PDF', 'periode'=>'Année 2024', 'par'=>'Awa SABI', 'date'=>'15/01/2025'],
                            ['nom'=>'Export matières premières', 'type'=>'Excel', 'periode'=>'T4 2024', 'par'=>'Marie HOUN', 'date'=>'10/01/2025'],
                            ['nom'=>'Rapport production T3 2024', 'type'=>'PDF', 'periode'=>'T3 2024', 'par'=>'Awa SABI', 'date'=>'05/10/2024'],
                        ];
                    @endphp

                    @foreach($rapports as $r)
                    <tr>
                        <td class="fw-semibold" style="font-size:14px;">{{ $r['nom'] }}</td>
                        <td>
                            @if($r['type'] === 'PDF')
                                <span class="badge rounded-pill" style="background:#fee2e2; color:#dc2626;">
                                    <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                                </span>
                            @else
                                <span class="badge rounded-pill" style="background:#dcfce7; color:#16a34a;">
                                    <i class="bi bi-file-earmark-excel me-1"></i>Excel
                                </span>
                            @endif
                        </td>
                        <td style="font-size:13px;">{{ $r['periode'] }}</td>
                        <td style="font-size:13px;">{{ $r['par'] }}</td>
                        <td style="font-size:13px; color:gray;">{{ $r['date'] }}</td>
                        <td>
                            <button class="btn btn-sm rounded-2"
                                    style="background:#e0f0ff; color:var(--primary); font-size:12px;">
                                <i class="bi bi-download me-1"></i> Télécharger
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection