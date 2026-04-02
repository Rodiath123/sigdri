@extends('layouts.app')

@section('title', 'Unités industrielles')
@section('page-title', 'Unités industrielles')
@section('page-subtitle', 'Gestion des unités industrielles enregistrées')

@section('content')

    <!-- Stats rapides -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Total unités</p>
                        <h3 class="fw-bold mb-0">342</h3>
                    </div>
                    <i class="bi bi-buildings" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card orange">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Actives</p>
                        <h3 class="fw-bold mb-0">298</h3>
                    </div>
                    <i class="bi bi-check-circle" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card pink">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Inactives</p>
                        <h3 class="fw-bold mb-0">44</h3>
                    </div>
                    <i class="bi bi-pause-circle" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card dark">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Départements</p>
                        <h3 class="fw-bold mb-0">12</h3>
                    </div>
                    <i class="bi bi-geo-alt" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color:var(--primary)">
                <i class="bi bi-buildings me-2" style="color:var(--secondary)"></i>
                Liste des unités industrielles
            </h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm rounded-3"
                       placeholder="🔍 Rechercher..." style="width:200px;">
                <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;"
                        data-bs-toggle="modal" data-bs-target="#modalAjouter">
                    <i class="bi bi-plus-lg me-1"></i> Ajouter
                </button>
            </div>
        </div>

        <!-- Filtres -->
        <div class="row g-2 mb-3">
            <div class="col-md-3">
                <select class="form-select form-select-sm rounded-3">
                    <option>Toutes les filières</option>
                    <option>Agro-alimentaire</option>
                    <option>Textile</option>
                    <option>BTP</option>
                    <option>Agriculture</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select form-select-sm rounded-3">
                    <option>Tous les départements</option>
                    <option>Littoral</option>
                    <option>Atlantique</option>
                    <option>Ouémé</option>
                    <option>Borgou</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select form-select-sm rounded-3">
                    <option>Tous les statuts</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f0f4f8;">
                    <tr>
                        <th style="font-size:13px;">#</th>
                        <th style="font-size:13px;">Nom de l'unité</th>
                        <th style="font-size:13px;">Filière</th>
                        <th style="font-size:13px;">Département</th>
                        <th style="font-size:13px;">Régime</th>
                        <th style="font-size:13px;">Responsable</th>
                        <th style="font-size:13px;">Statut</th>
                        <th style="font-size:13px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $unites = [
                            ['id'=>1, 'nom'=>'SOBEBRA', 'filiere'=>'Agro-alimentaire', 'dept'=>'Littoral', 'regime'=>'Privé', 'responsable'=>'Jean KOFFI', 'statut'=>'Active'],
                            ['id'=>2, 'nom'=>'COTONOU TEXTILE', 'filiere'=>'Textile', 'dept'=>'Atlantique', 'regime'=>'Privé', 'responsable'=>'Marie HOUN', 'statut'=>'Active'],
                            ['id'=>3, 'nom'=>'BÉNIN CIMENT', 'filiere'=>'BTP', 'dept'=>'Ouémé', 'regime'=>'Mixte', 'responsable'=>'Paul AGBO', 'statut'=>'Inactive'],
                            ['id'=>4, 'nom'=>'AGRO BÉNIN', 'filiere'=>'Agriculture', 'dept'=>'Zou', 'regime'=>'Public', 'responsable'=>'Awa SABI', 'statut'=>'Active'],
                            ['id'=>5, 'nom'=>'SAPH BÉNIN', 'filiere'=>'Agro-alimentaire', 'dept'=>'Borgou', 'regime'=>'Privé', 'responsable'=>'Félix DOSSA', 'statut'=>'Active'],
                        ];
                    @endphp

                    @foreach($unites as $u)
                    <tr>
                        <td style="font-size:13px; color:gray;">#{{ $u['id'] }}</td>
                        <td class="fw-semibold" style="font-size:14px;">{{ $u['nom'] }}</td>
                        <td style="font-size:13px;">{{ $u['filiere'] }}</td>
                        <td style="font-size:13px;">{{ $u['dept'] }}</td>
                        <td>
                            @if($u['regime'] === 'Privé')
                                <span class="badge rounded-pill" style="background:#e0f0ff; color:var(--primary);">Privé</span>
                            @elseif($u['regime'] === 'Public')
                                <span class="badge rounded-pill" style="background:#dcfce7; color:#16a34a;">Public</span>
                            @else
                                <span class="badge rounded-pill" style="background:#fef9c3; color:#854d0e;">Mixte</span>
                            @endif
                        </td>
                        <td style="font-size:13px;">{{ $u['responsable'] }}</td>
                        <td>
                            @if($u['statut'] === 'Active')
                                <span class="badge rounded-pill bg-success">● Active</span>
                            @else
                                <span class="badge rounded-pill bg-secondary">● Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm rounded-2"
                                        style="background:#e0f0ff; color:var(--primary); font-size:12px;"
                                        title="Voir détail"
                                        onclick="voirUnite('{{ $u['nom'] }}', '{{ $u['filiere'] }}', '{{ $u['dept'] }}', '{{ $u['regime'] }}', '{{ $u['responsable'] }}', '{{ $u['statut'] }}')"
                                        data-bs-toggle="modal" data-bs-target="#modalVoir">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fef9c3; color:#854d0e; font-size:12px;"
                                        title="Modifier"
                                        onclick="modifierUnite('{{ $u['nom'] }}', '{{ $u['filiere'] }}', '{{ $u['dept'] }}', '{{ $u['regime'] }}', '{{ $u['responsable'] }}')"
                                        data-bs-toggle="modal" data-bs-target="#modalModifier">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fee2e2; color:#dc2626; font-size:12px;"
                                        title="Supprimer"
                                        onclick="supprimerUnite('{{ $u['nom'] }}')"
                                        data-bs-toggle="modal" data-bs-target="#modalSupprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Affichage de 1 à 5 sur 342 unités</small>
            <nav>
                <ul class="pagination pagination-sm mb-0" id="paginationUnites">
                    <li class="page-item disabled"><a class="page-link rounded-2" href="#">‹</a></li>
                    <li class="page-item active">
                        <a class="page-link rounded-2" href="#"
                           style="background:var(--primary); border-color:var(--primary); color:white;">1</a>
                    </li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">2</a></li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">3</a></li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">›</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Modal Voir -->
    <div class="modal fade" id="modalVoir" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-buildings me-2" style="color:var(--secondary)"></i>
                        Détail de l'unité
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">NOM</label>
                            <p class="fw-bold mb-0" id="voirNom" style="color:var(--primary)"></p>
                        </div>
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">FILIÈRE</label>
                            <p class="fw-bold mb-0" id="voirFiliere" style="color:var(--primary)"></p>
                        </div>
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">DÉPARTEMENT</label>
                            <p class="fw-bold mb-0" id="voirDept" style="color:var(--primary)"></p>
                        </div>
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">RÉGIME</label>
                            <p class="fw-bold mb-0" id="voirRegime" style="color:var(--primary)"></p>
                        </div>
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">RESPONSABLE</label>
                            <p class="fw-bold mb-0" id="voirResponsable" style="color:var(--primary)"></p>
                        </div>
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">STATUT</label>
                            <p class="fw-bold mb-0" id="voirStatut" style="color:var(--primary)"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifier -->
    <div class="modal fade" id="modalModifier" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-pencil me-2" style="color:#854d0e"></i>
                        Modifier l'unité
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom</label>
                            <input type="text" class="form-control form-control-sm rounded-3" id="modNom">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                            <select class="form-select form-select-sm rounded-3" id="modFiliere">
                                <option>Agro-alimentaire</option>
                                <option>Textile</option>
                                <option>BTP</option>
                                <option>Agriculture</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                            <select class="form-select form-select-sm rounded-3" id="modDept">
                                <option>Littoral</option>
                                <option>Atlantique</option>
                                <option>Ouémé</option>
                                <option>Zou</option>
                                <option>Borgou</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Régime</label>
                            <select class="form-select form-select-sm rounded-3" id="modRegime">
                                <option>Privé</option>
                                <option>Public</option>
                                <option>Mixte</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Responsable</label>
                            <input type="text" class="form-control form-control-sm rounded-3" id="modResponsable">
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

    <!-- Modal Supprimer -->
    <div class="modal fade" id="modalSupprimer" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:#dc2626">
                        <i class="bi bi-trash me-2"></i> Supprimer l'unité
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="rounded-3 p-3" style="background:#fee2e2;">
                        <p class="mb-0" style="font-size:13px; color:#dc2626;">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Voulez-vous vraiment supprimer l'unité
                            <strong id="suppNom"></strong> ? Cette action est irréversible.
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:#dc2626; color:white;">
                        <i class="bi bi-trash me-1"></i> Confirmer la suppression
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajouter -->
    <div class="modal fade" id="modalAjouter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-plus-circle me-2" style="color:var(--secondary)"></i>
                        Ajouter une unité
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom de l'unité</label>
                            <input type="text" class="form-control form-control-sm rounded-3" placeholder="Ex: SOBEBRA">
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
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                            <select class="form-select form-select-sm rounded-3">
                                <option>Littoral</option>
                                <option>Atlantique</option>
                                <option>Ouémé</option>
                                <option>Zou</option>
                                <option>Borgou</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Régime</label>
                            <select class="form-select form-select-sm rounded-3">
                                <option>Privé</option>
                                <option>Public</option>
                                <option>Mixte</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Responsable</label>
                            <input type="text" class="form-control form-control-sm rounded-3" placeholder="Nom du responsable">
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

@endsection

@push('scripts')
<script>
    function voirUnite(nom, filiere, dept, regime, responsable, statut) {
        document.getElementById('voirNom').textContent = nom;
        document.getElementById('voirFiliere').textContent = filiere;
        document.getElementById('voirDept').textContent = dept;
        document.getElementById('voirRegime').textContent = regime;
        document.getElementById('voirResponsable').textContent = responsable;
        document.getElementById('voirStatut').textContent = statut;
    }

    function modifierUnite(nom, filiere, dept, regime, responsable) {
        document.getElementById('modNom').value = nom;
        document.getElementById('modFiliere').value = filiere;
        document.getElementById('modDept').value = dept;
        document.getElementById('modRegime').value = regime;
        document.getElementById('modResponsable').value = responsable;
    }

    function supprimerUnite(nom) {
        document.getElementById('suppNom').textContent = nom;
    }

    // Pagination
    document.querySelectorAll('#paginationUnites .page-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('#paginationUnites .page-item').forEach(function(item) {
                item.classList.remove('active');
                var l = item.querySelector('.page-link');
                if(l) { l.style.background = ''; l.style.borderColor = ''; l.style.color = ''; }
            });
            var parent = this.closest('.page-item');
            if(!parent.classList.contains('disabled')) {
                parent.classList.add('active');
                this.style.background = 'var(--primary)';
                this.style.borderColor = 'var(--primary)';
                this.style.color = 'white';
            }
        });
    });
</script>
@endpush