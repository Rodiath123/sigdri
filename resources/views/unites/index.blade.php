@extends('layouts.app')

@section('title', 'Unités industrielles')
@section('page-title', 'Unités industrielles')
@section('page-subtitle', 'Gestion des unités industrielles enregistrées')

@section('content')
    @php
        use App\Models\UniteIndustrielle;
        $unites = UniteIndustrielle::orderBy('nom')->get();
        $totalUnites = $unites->count();
        $activesCount = $unites->where('est_actif', true)->count();
        $inactivesCount = $unites->where('est_actif', false)->count();
        $departements = $unites->pluck('departement')->unique()->count();
    @endphp

    <!-- Stats rapides -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Total unités</p>
                        <h3 class="fw-bold mb-0">{{ $totalUnites }}</h3>
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
                        <h3 class="fw-bold mb-0">{{ $activesCount }}</h3>
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
                        <h3 class="fw-bold mb-0">{{ $inactivesCount }}</h3>
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
                        <h3 class="fw-bold mb-0">{{ $departements }}</h3>
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
            <div>
                <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;"
                        data-bs-toggle="modal" data-bs-target="#modalAjouter">
                    <i class="bi bi-plus-lg me-1"></i> Ajouter
                </button>
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
                    @foreach($unites as $u)
                    <tr>
                        <td style="font-size:13px; color:gray;">#{{ $u->id }}</td>
                        <td class="fw-semibold" style="font-size:14px;">{{ $u->nom }}</td>
                        <td style="font-size:13px;">{{ $u->filiere }}</td>
                        <td style="font-size:13px;">{{ $u->departement }}</td>
                        <td>
                            @if($u->regime === 'Privé')
                                <span class="badge rounded-pill" style="background:#e0f0ff; color:var(--primary);">Privé</span>
                            @elseif($u->regime === 'Public')
                                <span class="badge rounded-pill" style="background:#dcfce7; color:#16a34a;">Public</span>
                            @else
                                <span class="badge rounded-pill" style="background:#fef9c3; color:#854d0e;">Mixte</span>
                            @endif
                        </td>
                        <td style="font-size:13px;">{{ $u->contact_nom }}</td>
                        <td>
                            @if($u->est_actif)
                                <span class="badge rounded-pill bg-success">● Active</span>
                            @else
                                <span class="badge rounded-pill bg-secondary">● Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm rounded-2" style="background:#e0f0ff; color:var(--primary);"
                                        onclick='voirUnite(@json($u))' data-bs-toggle="modal" data-bs-target="#modalVoir">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm rounded-2" style="background:#fef9c3; color:#854d0e;"
                                        onclick='modifierUnite(@json($u))' data-bs-toggle="modal" data-bs-target="#modalModifier">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm rounded-2" style="background:#fee2e2; color:#dc2626;"
                                        onclick='supprimerUnite(@json($u))' data-bs-toggle="modal" data-bs-target="#modalSupprimer">
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
                    <button type="button" class="btn btn-sm rounded-3" style="background:#f0f4f8; color:var(--primary);" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifier -->
    <div class="modal fade" id="modalModifier" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formModifier" method="POST">
                @csrf
                @method('PUT')
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
                                <input type="text" class="form-control form-control-sm rounded-3" name="nom" id="modNom" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                                <input type="text" class="form-control form-control-sm rounded-3" name="filiere" id="modFiliere" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                                <input type="text" class="form-control form-control-sm rounded-3" name="departement" id="modDept" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Régime</label>
                                <select class="form-select form-select-sm rounded-3" name="regime" id="modRegime" required>
                                    <option>Privé</option>
                                    <option>Public</option>
                                    <option>Mixte</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Responsable</label>
                                <input type="text" class="form-control form-control-sm rounded-3" name="contact_nom" id="modResponsable" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-sm rounded-3" style="background:#f0f4f8; color:var(--primary);" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold" style="background:var(--primary); color:white;">
                            <i class="bi bi-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Supprimer -->
    <div class="modal fade" id="modalSupprimer" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formSupprimer" method="POST">
                @csrf
                @method('DELETE')
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
                        <button type="button" class="btn btn-sm rounded-3" style="background:#f0f4f8; color:var(--primary);" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold" style="background:#dc2626; color:white;">
                            <i class="bi bi-trash me-1"></i> Confirmer la suppression
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Ajouter -->
<div class="modal fade" id="modalAjouter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4">
            <form method="POST" action="{{ route('unites.store') }}">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-plus-circle me-2" style="color:var(--secondary)"></i>
                        Ajouter une unité industrielle
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom de l'unité *</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="nom" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Localisation *</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="localisation" placeholder="Adresse complète" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département *</label>
                            <select class="form-select form-select-sm rounded-3" name="departement" required>
                                <option value="">Sélectionner</option>
                                <option>Alibori</option>
                                <option>Atacora</option>
                                <option>Atlantique</option>
                                <option>Borgou</option>
                                <option>Collines</option>
                                <option>Couffo</option>
                                <option>Donga</option>
                                <option>Littoral</option>
                                <option>Mono</option>
                                <option>Ouémé</option>
                                <option>Plateau</option>
                                <option>Zou</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière *</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="filiere" placeholder="Ex: Agroalimentaire, Textile..." required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Capacité installée (tonnes)</label>
                            <input type="number" step="0.01" class="form-control form-control-sm rounded-3" name="capacite_installee" placeholder="0.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Régime *</label>
                            <select class="form-select form-select-sm rounded-3" name="regime" required>
                                <option>Privé</option>
                                <option>Public</option>
                                <option>Mixte</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Responsable *</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="contact_nom" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Téléphone</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="contact_telephone" placeholder="+229 XX XX XX XX">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Email</label>
                            <input type="email" class="form-control form-control-sm rounded-3" name="contact_email" placeholder="contact@email.com">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--secondary); color:white;">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function voirUnite(data) {
        document.getElementById('voirNom').textContent = data.nom;
        document.getElementById('voirFiliere').textContent = data.filiere;
        document.getElementById('voirDept').textContent = data.departement;
        document.getElementById('voirRegime').textContent = data.regime;
        document.getElementById('voirResponsable').textContent = data.contact_nom;
        document.getElementById('voirStatut').textContent = data.est_actif ? 'Active' : 'Inactive';
    }

    function modifierUnite(data) {
        document.getElementById('formModifier').action = '/unites/' + data.id;
        document.getElementById('modNom').value = data.nom;
        document.getElementById('modFiliere').value = data.filiere;
        document.getElementById('modDept').value = data.departement;
        document.getElementById('modRegime').value = data.regime;
        document.getElementById('modResponsable').value = data.contact_nom;
    }

    function supprimerUnite(data) {
        document.getElementById('formSupprimer').action = '/unites/' + data.id;
        document.getElementById('suppNom').textContent = data.nom;
    }
</script>
@endpush