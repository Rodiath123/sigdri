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
                        Déclaration #{{ $declaration->id }} - {{ $declaration->uniteIndustrielle->nom ?? 'N/A' }}
                    </h6>
                    <span class="badge rounded-pill 
                        @if($declaration->statut === 'en_attente') bg-warning text-dark
                        @elseif($declaration->statut === 'validee') bg-success
                        @else bg-danger @endif">
                        @if($declaration->statut === 'en_attente') ⏳ En attente
                        @elseif($declaration->statut === 'validee') ✓ Validée
                        @else ✗ Rejetée @endif
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">INDUSTRIEL</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">{{ $declaration->uniteIndustrielle->nom ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">FILIÈRE</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">{{ $declaration->uniteIndustrielle->filiere ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">DÉPARTEMENT</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">{{ $declaration->uniteIndustrielle->departement ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">TRIMESTRE</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">T{{ $declaration->trimestre }} {{ $declaration->annee }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">DATE SOUMISSION</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">{{ $declaration->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">RÉGIME</label>
                        <p class="fw-bold mb-0" style="color:var(--primary);">{{ $declaration->uniteIndustrielle->regime ?? 'N/A' }}</p>
                    </div>
                    @if($declaration->statut === 'rejetee' && $declaration->commentaire_rejet)
                    <div class="col-12">
                        <label class="form-label fw-semibold" style="font-size:12px; color:gray;">MOTIF DU REJET</label>
                        <p class="mb-0" style="color:#dc2626;">{{ $declaration->commentaire_rejet }}</p>
                    </div>
                    @endif
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
                            @forelse($declaration->venteDetails as $vente)
                            <tr>
                                <td style="font-size:13px;">{{ $vente->produit->nom ?? 'N/A' }}</td>
                                @php
                                    $production = $declaration->productionDetails->where('produit_id', $vente->produit_id)->first();
                                @endphp
                                <td style="font-size:13px;">{{ number_format($production->quantite_produite ?? 0, 2) }}</td>
                                <td style="font-size:13px;">{{ $vente->marche === 'local' ? number_format($vente->quantite_vendue, 2) : '-' }}</td>
                                <td style="font-size:13px;">{{ $vente->marche === 'export' ? number_format($vente->quantite_vendue, 2) : '-' }}</td>
                                <td style="font-size:13px;">{{ number_format($vente->chiffre_affaires, 0) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucune donnée de vente</td>
                            </tr>
                            @endforelse
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
                                <th style="font-size:13px;">Origine</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($declaration->consommationMPDetails as $consommation)
                            <tr>
                                <td style="font-size:13px;">{{ $consommation->matierePremiere->nom ?? 'N/A' }}</td>
                                <td style="font-size:13px;">{{ number_format($consommation->quantite_utilisee, 2) }}</td>
                                <td style="font-size:13px;">{{ $consommation->matierePremiere->origine ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Aucune consommation de matière première</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Colonne droite -->
        <div class="col-md-4">

            <!-- Actions -->
            @if($declaration->statut === 'en_attente')
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color:var(--primary)">
                    <i class="bi bi-lightning me-2" style="color:var(--secondary)"></i>
                    Actions
                </h6>
                <div class="d-flex flex-column gap-2">
                    <form method="POST" action="{{ route('declarations.valider', $declaration->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn rounded-3 fw-semibold w-100"
                                style="background:#16a34a; color:white;">
                            <i class="bi bi-check-lg me-1"></i> Valider la déclaration
                        </button>
                    </form>
                    <button type="button" class="btn rounded-3 fw-semibold"
                            style="background:#dc2626; color:white;"
                            data-bs-toggle="modal" data-bs-target="#modalRejeter">
                        <i class="bi bi-x-lg me-1"></i> Rejeter la déclaration
                    </button>
                    <button class="btn rounded-3 fw-semibold"
                            style="background:#f0f4f8; color:var(--primary);">
                        <i class="bi bi-download me-1"></i> Télécharger PDF
                    </button>
                </div>
            </div>
            @endif

            <!-- Capacité installée -->
            <div class="card p-4 mb-4">
                <h6 class="fw-bold mb-3" style="color:var(--primary)">
                    <i class="bi bi-speedometer me-2" style="color:var(--secondary)"></i>
                    Capacité installée
                </h6>
                @php
                    $capacite = $declaration->uniteIndustrielle->capacite_installee ?? 0;
                    $productionTotale = $declaration->productionDetails->sum('quantite_produite');
                    $tauxUtilisation = $capacite > 0 ? round(($productionTotale / $capacite) * 100) : 0;
                @endphp
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Capacité totale</small>
                    <small class="fw-semibold">{{ number_format($capacite, 0) }} tonnes/mois</small>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Production réelle</small>
                    <small class="fw-semibold">{{ number_format($productionTotale, 2) }} tonnes</small>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <small class="text-muted">Taux d'utilisation</small>
                    <small class="fw-semibold" style="color:var(--secondary)">{{ $tauxUtilisation }}%</small>
                </div>
                <div class="progress rounded-3" style="height:8px;">
                    <div class="progress-bar" style="width:{{ $tauxUtilisation }}%; background:var(--secondary);"></div>
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
                            <div style="font-size:11px; color:gray;">{{ $declaration->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                    @if($declaration->statut !== 'en_attente')
                    <div class="d-flex gap-2">
                        <div class="rounded-circle flex-shrink-0"
                             style="width:10px; height:10px; background:{{ $declaration->statut === 'validee' ? '#16a34a' : '#dc2626' }}; margin-top:4px;"></div>
                        <div>
                            <div style="font-size:13px; font-weight:600;">{{ $declaration->statut === 'validee' ? 'Validée' : 'Rejetée' }}</div>
                            <div style="font-size:11px; color:gray;">{{ $declaration->date_validation ? \Carbon\Carbon::parse($declaration->date_validation)->format('d/m/Y H:i') : 'Date inconnue' }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rejeter -->
    <div class="modal fade" id="modalRejeter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('declarations.rejeter', $declaration->id) }}">
                @csrf
                @method('PATCH')
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
                                Vous rejetez la déclaration de <strong>{{ $declaration->uniteIndustrielle->nom ?? 'cet industriel' }}</strong>.
                            </p>
                        </div>
                        <textarea name="commentaire_rejet" class="form-control rounded-3" rows="3"
                                  placeholder="Motif du rejet..." required></textarea>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-sm rounded-3"
                                style="background:#f0f4f8; color:var(--primary);"
                                data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold"
                                style="background:#dc2626; color:white;">
                            <i class="bi bi-x-lg me-1"></i> Confirmer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection