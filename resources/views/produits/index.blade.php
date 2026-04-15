@extends('layouts.app')

@section('title', 'Produits & Matières premières')
@section('page-title', 'Produits & Matières premières')
@section('page-subtitle', 'Gestion des catalogues produits et matières premières')

@section('content')

    <!-- Onglets -->
    <div class="d-flex gap-2 mb-4">
        <button class="btn btn-sm rounded-3 fw-semibold" id="tab-produits"
                style="background:var(--primary); color:white; font-size:13px;">
            <i class="bi bi-box-seam me-1"></i> Produits
        </button>
        <button class="btn btn-sm rounded-3 fw-semibold" id="tab-matieres"
                style="background:#f0f4f8; color:var(--primary); font-size:13px;">
            <i class="bi bi-basket me-1"></i> Matières premières
        </button>
    </div>

    <!-- Section Produits -->
    <div id="section-produits">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0" style="color:var(--primary)">
                    <i class="bi bi-box-seam me-2" style="color:var(--secondary)"></i>
                    Catalogue des produits
                </h6>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control form-control-sm rounded-3"
                           placeholder="🔍 Rechercher..." style="width:200px;">
                    <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;"
                            data-bs-toggle="modal" data-bs-target="#modalAjouterProduit">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead style="background:#f0f4f8;">
                        <tr>
                            <th style="font-size:13px;">#</th>
                            <th style="font-size:13px;">Nom du produit</th>
                            <th style="font-size:13px;">Filière</th>
                            <th style="font-size:13px;">Unité de mesure</th>
                            <th style="font-size:13px;">Code</th>
                            <th style="font-size:13px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $produits = [
                                ['id'=>1, 'nom'=>'Bière locale', 'filiere'=>'Agro-alimentaire', 'unite'=>'Hectolitre', 'code'=>'PRD-001'],
                                ['id'=>2, 'nom'=>'Tissu wax', 'filiere'=>'Textile', 'unite'=>'Mètre', 'code'=>'PRD-002'],
                                ['id'=>3, 'nom'=>'Ciment Portland', 'filiere'=>'BTP', 'unite'=>'Tonne', 'code'=>'PRD-003'],
                                ['id'=>4, 'nom'=>'Huile de palme', 'filiere'=>'Agriculture', 'unite'=>'Litre', 'code'=>'PRD-004'],
                                ['id'=>5, 'nom'=>'Farine de blé', 'filiere'=>'Agro-alimentaire', 'unite'=>'Tonne', 'code'=>'PRD-005'],
                            ];
                        @endphp

                        @foreach($produits as $p)
                        <tr>
                            <td style="font-size:13px; color:gray;">#{{ $p['id'] }}</td>
                            <td class="fw-semibold" style="font-size:14px;">{{ $p['nom'] }}</td>
                            <td style="font-size:13px;">{{ $p['filiere'] }}</td>
                            <td style="font-size:13px;">{{ $p['unite'] }}</td>
                            <td>
                                <span class="badge rounded-pill"
                                      style="background:#e0f0ff; color:var(--primary); font-size:12px;">
                                    {{ $p['code'] }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm rounded-2"
                                            style="background:#fef9c3; color:#854d0e; font-size:12px;"
                                            onclick="modifierProduit('{{ $p['nom'] }}', '{{ $p['filiere'] }}', '{{ $p['unite'] }}', '{{ $p['code'] }}')"
                                            data-bs-toggle="modal" data-bs-target="#modalModifierProduit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm rounded-2"
                                            style="background:#fee2e2; color:#dc2626; font-size:12px;"
                                            onclick="supprimerProduit('{{ $p['nom'] }}')"
                                            data-bs-toggle="modal" data-bs-target="#modalSupprimerProduit">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Section Matières premières -->
    <div id="section-matieres" style="display:none;">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0" style="color:var(--primary)">
                    <i class="bi bi-basket me-2" style="color:var(--accent)"></i>
                    Catalogue des matières premières
                </h6>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control form-control-sm rounded-3"
                           placeholder="🔍 Rechercher..." style="width:200px;">
                    <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;"
                            data-bs-toggle="modal" data-bs-target="#modalAjouterMatiere">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead style="background:#f0f4f8;">
                        <tr>
                            <th style="font-size:13px;">#</th>
                            <th style="font-size:13px;">Matière première</th>
                            <th style="font-size:13px;">Filière</th>
                            <th style="font-size:13px;">Origine</th>
                            <th style="font-size:13px;">Unité</th>
                            <th style="font-size:13px;">Disponibilité</th>
                            <th style="font-size:13px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $matieres = [
                                ['id'=>1, 'nom'=>'Coton brut', 'filiere'=>'Textile', 'origine'=>'Locale', 'unite'=>'Tonne', 'dispo'=>'Disponible'],
                                ['id'=>2, 'nom'=>'Soja', 'filiere'=>'Agro-alimentaire', 'origine'=>'Locale', 'unite'=>'Tonne', 'dispo'=>'Tension'],
                                ['id'=>3, 'nom'=>'Anacarde', 'filiere'=>'Agriculture', 'origine'=>'Locale', 'unite'=>'Tonne', 'dispo'=>'Disponible'],
                                ['id'=>4, 'nom'=>'Ciment gris', 'filiere'=>'BTP', 'origine'=>'Importée', 'unite'=>'Tonne', 'dispo'=>'Rupture'],
                                ['id'=>5, 'nom'=>'Blé dur', 'filiere'=>'Agro-alimentaire', 'origine'=>'Importée', 'unite'=>'Tonne', 'dispo'=>'Tension'],
                            ];
                        @endphp

                        @foreach($matieres as $m)
                        <tr>
                            <td style="font-size:13px; color:gray;">#{{ $m['id'] }}</td>
                            <td class="fw-semibold" style="font-size:14px;">{{ $m['nom'] }}</td>
                            <td style="font-size:13px;">{{ $m['filiere'] }}</td>
                            <td>
                                @if($m['origine'] === 'Locale')
                                    <span class="badge rounded-pill" style="background:#dcfce7; color:#16a34a;">Locale</span>
                                @else
                                    <span class="badge rounded-pill" style="background:#fef3c7; color:#92400e;">Importée</span>
                                @endif
                            </td>
                            <td style="font-size:13px;">{{ $m['unite'] }}</td>
                            <td>
                                @if($m['dispo'] === 'Disponible')
                                    <span class="badge rounded-pill bg-success">● Disponible</span>
                                @elseif($m['dispo'] === 'Tension')
                                    <span class="badge rounded-pill bg-warning text-dark">⚠ Tension</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">✗ Rupture</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm rounded-2"
                                            style="background:#fef9c3; color:#854d0e; font-size:12px;"
                                            onclick="modifierMatiere('{{ $m['nom'] }}', '{{ $m['filiere'] }}', '{{ $m['origine'] }}', '{{ $m['unite'] }}', '{{ $m['dispo'] }}')"
                                            data-bs-toggle="modal" data-bs-target="#modalModifierMatiere">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm rounded-2"
                                            style="background:#fee2e2; color:#dc2626; font-size:12px;"
                                            onclick="supprimerMatiere('{{ $m['nom'] }}')"
                                            data-bs-toggle="modal" data-bs-target="#modalSupprimerMatiere">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Ajouter Produit -->
    <div class="modal fade" id="modalAjouterProduit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-plus-circle me-2" style="color:var(--secondary)"></i>
                        Ajouter un produit
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom du produit</label>
                            <input type="text" class="form-control form-control-sm rounded-3" placeholder="Ex: Bière locale">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                            <select class="form-select form-select-sm rounded-3">
                                <option>Agro-alimentaire</option>
                                <option>Textile</option>
                                <option>BTP</option>
                                <option>Agriculture</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Unité de mesure</label>
                            <input type="text" class="form-control form-control-sm rounded-3" placeholder="Ex: Tonne">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Code</label>
                            <input type="text" class="form-control form-control-sm rounded-3" placeholder="Ex: PRD-006">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--secondary); color:white;">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifier Produit -->
    <div class="modal fade" id="modalModifierProduit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-pencil me-2" style="color:#854d0e"></i>
                        Modifier le produit
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom</label>
                            <input type="text" class="form-control form-control-sm rounded-3" id="modProdNom">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                            <select class="form-select form-select-sm rounded-3" id="modProdFiliere">
                                <option>Agro-alimentaire</option>
                                <option>Textile</option>
                                <option>BTP</option>
                                <option>Agriculture</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Unité</label>
                            <input type="text" class="form-control form-control-sm rounded-3" id="modProdUnite">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Code</label>
                            <input type="text" class="form-control form-control-sm rounded-3" id="modProdCode">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--primary); color:white;">
                        <i class="bi bi-save me-1"></i> Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Supprimer Produit -->
    <div class="modal fade" id="modalSupprimerProduit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:#dc2626">
                        <i class="bi bi-trash me-2"></i> Supprimer le produit
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="rounded-3 p-3" style="background:#fee2e2;">
                        <p class="mb-0" style="font-size:13px; color:#dc2626;">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Voulez-vous vraiment supprimer le produit
                            <strong id="suppProdNom"></strong> ?
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:#dc2626; color:white;">
                        <i class="bi bi-trash me-1"></i> Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajouter Matière -->
    <div class="modal fade" id="modalAjouterMatiere" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-plus-circle me-2" style="color:var(--accent)"></i>
                        Ajouter une matière première
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom</label>
                            <input type="text" class="form-control form-control-sm rounded-3" placeholder="Ex: Coton brut">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                            <select class="form-select form-select-sm rounded-3">
                                <option>Agro-alimentaire</option>
                                <option>Textile</option>
                                <option>BTP</option>
                                <option>Agriculture</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Origine</label>
                            <select class="form-select form-select-sm rounded-3">
                                <option>Locale</option>
                                <option>Importée</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Unité</label>
                            <input type="text" class="form-control form-control-sm rounded-3" placeholder="Ex: Tonne">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Disponibilité</label>
                            <select class="form-select form-select-sm rounded-3">
                                <option>Disponible</option>
                                <option>Tension</option>
                                <option>Rupture</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--secondary); color:white;">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifier Matière -->
    <div class="modal fade" id="modalModifierMatiere" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-pencil me-2" style="color:#854d0e"></i>
                        Modifier la matière première
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom</label>
                            <input type="text" class="form-control form-control-sm rounded-3" id="modMatNom">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                            <select class="form-select form-select-sm rounded-3" id="modMatFiliere">
                                <option>Agro-alimentaire</option>
                                <option>Textile</option>
                                <option>BTP</option>
                                <option>Agriculture</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Origine</label>
                            <select class="form-select form-select-sm rounded-3" id="modMatOrigine">
                                <option>Locale</option>
                                <option>Importée</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Unité</label>
                            <input type="text" class="form-control form-control-sm rounded-3" id="modMatUnite">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Disponibilité</label>
                            <select class="form-select form-select-sm rounded-3" id="modMatDispo">
                                <option>Disponible</option>
                                <option>Tension</option>
                                <option>Rupture</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--primary); color:white;">
                        <i class="bi bi-save me-1"></i> Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Supprimer Matière -->
    <div class="modal fade" id="modalSupprimerMatiere" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:#dc2626">
                        <i class="bi bi-trash me-2"></i> Supprimer la matière première
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="rounded-3 p-3" style="background:#fee2e2;">
                        <p class="mb-0" style="font-size:13px; color:#dc2626;">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Voulez-vous vraiment supprimer
                            <strong id="suppMatNom"></strong> ?
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:#dc2626; color:white;">
                        <i class="bi bi-trash me-1"></i> Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Onglets
    document.getElementById('tab-produits').onclick = function() {
        document.getElementById('section-produits').style.display = 'block';
        document.getElementById('section-matieres').style.display = 'none';
        document.getElementById('tab-produits').style.background = 'var(--primary)';
        document.getElementById('tab-produits').style.color = 'white';
        document.getElementById('tab-matieres').style.background = '#f0f4f8';
        document.getElementById('tab-matieres').style.color = 'var(--primary)';
    };

    document.getElementById('tab-matieres').onclick = function() {
        document.getElementById('section-matieres').style.display = 'block';
        document.getElementById('section-produits').style.display = 'none';
        document.getElementById('tab-matieres').style.background = 'var(--primary)';
        document.getElementById('tab-matieres').style.color = 'white';
        document.getElementById('tab-produits').style.background = '#f0f4f8';
        document.getElementById('tab-produits').style.color = 'var(--primary)';
    };

    // Produits
    function modifierProduit(nom, filiere, unite, code) {
        document.getElementById('modProdNom').value = nom;
        document.getElementById('modProdFiliere').value = filiere;
        document.getElementById('modProdUnite').value = unite;
        document.getElementById('modProdCode').value = code;
    }

    function supprimerProduit(nom) {
        document.getElementById('suppProdNom').textContent = nom;
    }

    // Matières
    function modifierMatiere(nom, filiere, origine, unite, dispo) {
        document.getElementById('modMatNom').value = nom;
        document.getElementById('modMatFiliere').value = filiere;
        document.getElementById('modMatOrigine').value = origine;
        document.getElementById('modMatUnite').value = unite;
        document.getElementById('modMatDispo').value = dispo;
    }

    function supprimerMatiere(nom) {
        document.getElementById('suppMatNom').textContent = nom;
    }
</script>
@endpush