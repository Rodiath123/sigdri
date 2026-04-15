@extends('layouts.app')

@section('title', 'Détail déclaration')
@section('page-title', 'Détail de la déclaration')
@section('page-subtitle', 'Informations complètes de la déclaration')

@section('content')

    <!-- Bouton retour -->
    <div class="mb-4">
        <a href="{{ route('declarations.index') }}" class="btn btn-sm rounded-3"
           style="background:#f0f4f8; color:var(--primary);">
            <i class="bi bi-arrow-left me-1"></i> Retour aux déclarations
        </a>
    </div>

    <div class="row g-4">

        <!-- Infos générales -->
        <div class="col-md-8">
            <div class="card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold mb-0" style="color:var(--primary)">
                        <i class="bi bi-file-earmark-text me-2" style="color:var(--secondary)"></i>
                        Déclaration #2 - COTONOU TEXTILE
                    </h6>
                    <span class="badge rounded-pill bg-warning text-dark">⏳ En attente</span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">INDUSTRIEL</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">COTONOU TEXTILE</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">FILIÈRE</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">Textile</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">DÉPARTEMENT</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">Atlantique</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">TRIMESTRE</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">T1 2025</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">DATE SOUMISSION</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">24/03/2025</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">RÉGIME</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">Privé</p>
                    </div>
                </div>
            </div>

            <!-- Données de production -->
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-4" style="color:var(--primary)">
                    <i class="bi bi-bar-chart me-2" style="color:var(--secondary)"></i>
                    Données de production
                </h6>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead style="background:#f0f4f8;">
                            <tr>
                                <th style="font-size:13px;">Produit</th>
                                <th style="font-size:13px;">Production</th>
                                <th style="font-size:13px;">Ventes locales</th>
                                <th style="font-size:13px;">Exportations</th>
                                <th style="font-size:13px;">CA (FCFA)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size:13px;">Tissu wax</td>
                                <td style="font-size:13px;">1 200 m</td>
                                <td style="font-size:13px;">800 m</td>
                                <td style="font-size:13px;">400 m</td>
                                <td style="font-size:13px;">24 000 000</td>
                            </tr>
                            <tr>
                                <td style="font-size:13px;">Tissu basin</td>
                                <td style="font-size:13px;">850 m</td>
                                <td style="font-size:13px;">600 m</td>
                                <td style="font-size:13px;">250 m</td>
                                <td style="font-size:13px;">17 000 000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Matières premières -->
            <div class="card p-4">
                <h6 class="fw-bold mb-4" style="color:var(--primary)">
                    <i class="bi bi-basket me-2" style="color:var(--accent)"></i>
                    Consommation matières premières
                </h6>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead style="background:#f0f4f8;">
                            <tr>
                                <th style="font-size:13px;">Matière première</th>
                                <th style="font-size:13px;">Quantité utilisée</th>
                                <th style="font-size:13px;">Origine locale</th>
                                <th style="font-size:13px;">Origine importée</th>
                                <th style="font-size:13px;">Disponibilité</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size:13px;">Coton brut</td>
                                <td style="font-size:13px;">500 kg</td>
                                <td style="font-size:13px;">350 kg</td>
                                <td style="font-size:13px;">150 kg</td>
                                <td><span class="badge bg-success rounded-pill">Disponible</span></td>
                            </tr>
                            <tr>
                                <td style="font-size:13px;">Colorants</td>
                                <td style="font-size:13px;">120 L</td>
                                <td style="font-size:13px;">0 L</td>
                                <td style="font-size:13px;">120 L</td>
                                <td><span class="badge bg-warning text-dark rounded-pill">Tension</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Colonne droite -->
        <div class="col-md-4">

            <!-- Actions -->
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color:var(--primary)">
                    <i class="bi bi-lightning me-2" style="color:var(--secondary)"></i>
                    Actions
                </h6>
                <div class="d-flex flex-column gap-2">
                    <button class="btn rounded-3 fw-semibold"
                            style="background:#16a34a; color:white;"
                            data-bs-toggle="modal" data-bs-target="#modalValider"
                            onclick="ouvrirValider('COTONOU TEXTILE')">
                        <i class="bi bi-check-lg me-1"></i> Valider la déclaration
                    </button>
                    <button class="btn rounded-3 fw-semibold"
                            style="background:#dc2626; color:white;"
                            data-bs-toggle="modal" data-bs-target="#modalRejeter"
                            onclick="ouvrirRejeter('COTONOU TEXTILE')">
                        <i class="bi bi-x-lg me-1"></i> Rejeter la déclaration
                    </button>
                    <button class="btn rounded-3 fw-semibold"
                            style="background:#f0f4f8; color:var(--primary);">
                        <i class="bi bi-download me-1"></i> Télécharger PDF
                    </button>
                </div>
            </div>

            <!-- Capacité installée -->
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color:var(--primary)">
                    <i class="bi bi-speedometer me-2" style="color:var(--secondary)"></i>
                    Capacité installée
                </h6>
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Capacité totale</small>
                    <small class="fw-semibold">5 000 m/mois</small>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Production réelle</small>
                    <small class="fw-semibold">2 050 m</small>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <small class="text-muted">Taux d'utilisation</small>
                    <small class="fw-semibold" style="color:var(--secondary)">41%</small>
                </div>
                <div class="progress rounded-3" style="height:8px;">
                    <div class="progress-bar" style="width:41%; background:var(--secondary);"></div>
                </div>
            </div>

            <!-- Historique statuts -->
            <div class="card p-4">
                <h6 class="fw-bold mb-3" style="color:var(--primary)">
                    <i class="bi bi-clock-history me-2" style="color:var(--accent)"></i>
                    Historique
                </h6>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-2">
                        <div class="rounded-circle flex-shrink-0"
                             style="width:10px; height:10px; background:var(--secondary); margin-top:4px;"></div>
                        <div>
                            <div style="font-size:13px; font-weight:600;">Soumise</div>
                            <div style="font-size:11px; color:gray;">24/03/2025 à 10h15</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="rounded-circle flex-shrink-0"
                             style="width:10px; height:10px; background:#e5e7eb; margin-top:4px;"></div>
                        <div>
                            <div style="font-size:13px; color:gray;">En attente de validation</div>
                            <div style="font-size:11px; color:gray;">Depuis 24/03/2025</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="modalValider" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-check-circle me-2" style="color:#16a34a"></i>
                        Valider la déclaration
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="rounded-3 p-3 mb-3" style="background:#dcfce7;">
                        <p class="mb-0" style="font-size:13px; color:#16a34a;">
                            Vous validez la déclaration de <strong id="nomIndustrielValider"></strong>.
                        </p>
                    </div>
                    <textarea class="form-control rounded-3" rows="3"
                              placeholder="Commentaire (optionnel)..."></textarea>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:#16a34a; color:white;">
                        <i class="bi bi-check-lg me-1"></i> Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRejeter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-x-circle me-2" style="color:#dc2626"></i>
                        Rejeter la déclaration
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="rounded-3 p-3 mb-3" style="background:#fee2e2;">
                        <p class="mb-0" style="font-size:13px; color:#dc2626;">
                            Vous rejetez la déclaration de <strong id="nomIndustrielRejeter"></strong>.
                        </p>
                    </div>
                    <textarea class="form-control rounded-3" rows="3"
                              placeholder="Motif du rejet..." required></textarea>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:#dc2626; color:white;">
                        <i class="bi bi-x-lg me-1"></i> Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function ouvrirValider(nom) {
        document.getElementById('nomIndustrielValider').textContent = nom;
    }
    function ouvrirRejeter(nom) {
        document.getElementById('nomIndustrielRejeter').textContent = nom;
    }
</script>
@endpush