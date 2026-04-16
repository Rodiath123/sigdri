@extends('layouts.app')

@section('title', 'Produits & Matières premières')
@section('page-title', 'Produits & Matières premières')
@section('page-subtitle', 'Gestion des catalogues')

@section('content')

<!-- Onglets -->
<div class="mb-4">
    <div class="d-flex gap-2">
        <a href="{{ route('produits.index') }}" 
           class="btn rounded-pill {{ request()->routeIs('produits.*') ? 'active-onglet' : 'btn-onglet' }}"
           style="{{ request()->routeIs('produits.*') ? 'background: #1e3a5f; color: white; border: none;' : 'background: #f0f4f8; color: #1e3a5f; border: 1px solid #1e3a5f;' }} padding: 8px 20px; font-size: 14px;">
            <i class="bi bi-box-seam me-1"></i> Produits
        </a>
        <a href="{{ route('matieres-premieres.index') }}" 
           class="btn rounded-pill {{ request()->routeIs('matieres-premieres.*') ? 'active-onglet' : 'btn-onglet' }}"
           style="{{ request()->routeIs('matieres-premieres.*') ? 'background: #1e3a5f; color: white; border: none;' : 'background: #f0f4f8; color: #1e3a5f; border: 1px solid #1e3a5f;' }} padding: 8px 20px; font-size: 14px;">
            <i class="bi bi-droplet me-1"></i> Matières premières
        </a>
    </div>
</div>

<!-- Contenu Matières premières -->
@php
    use App\Models\MatierePremiere;
    $matieres = MatierePremiere::orderBy('nom')->get();
@endphp

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0" style="color:var(--primary)">
            <i class="bi bi-droplet me-2" style="color:var(--secondary)"></i>
            Liste des matières premières
        </h6>
        <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;"
                data-bs-toggle="modal" data-bs-target="#modalAjouter">
            <i class="bi bi-plus-lg me-1"></i> Ajouter
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead style="background:#f0f4f8;">
                <tr>
                    <th style="font-size:13px;">#</th>
                    <th style="font-size:13px;">Nom</th>
                    <th style="font-size:13px;">Origine</th>
                    <th style="font-size:13px;">Filière</th>
                    <th style="font-size:13px;">Statut</th>
                    <th style="font-size:13px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matieres as $m)
                <tr>
                    <td style="font-size:13px; color:gray;">#{{ $m->id }}</td>
                    <td class="fw-semibold" style="font-size:14px;">{{ $m->nom }}</td>
                    <td>
                        @if($m->origine === 'locale')
                            <span class="badge rounded-pill" style="background:#dcfce7; color:#16a34a;">Locale</span>
                        @else
                            <span class="badge rounded-pill" style="background:#e0f0ff; color:var(--primary);">Importée</span>
                        @endif
                    </td>
                    <td style="font-size:13px;">{{ $m->filiere }}</td>
                    <td>
                        @if($m->est_actif)
                            <span class="badge rounded-pill bg-success">● Actif</span>
                        @else
                            <span class="badge rounded-pill bg-secondary">● Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm rounded-2" style="background:#e0f0ff; color:var(--primary);"
                                    onclick='voirMatiere(@json($m))' data-bs-toggle="modal" data-bs-target="#modalVoir">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-sm rounded-2" style="background:#fef9c3; color:#854d0e;"
                                    onclick='modifierMatiere(@json($m))' data-bs-toggle="modal" data-bs-target="#modalModifier">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form method="POST" action="{{ route('matieres-premieres.toggle', $m->id) }}" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm rounded-2" style="background:#f0f4f8; color:gray;">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Ajouter -->
<div class="modal fade" id="modalAjouter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('matieres-premieres.store') }}">
            @csrf
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-plus-circle me-2" style="color:var(--secondary)"></i>
                        Ajouter une matière première
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="nom" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Origine</label>
                            <select class="form-select form-select-sm rounded-3" name="origine" required>
                                <option value="locale">Locale</option>
                                <option value="importee">Importée</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                            <input type="text" class="form-control form-control-sm rounded-3" name="filiere" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3" style="background:#f0f4f8; color:var(--primary);" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-sm rounded-3 fw-semibold" style="background:var(--secondary); color:white;">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Voir -->
<div class="modal fade" id="modalVoir" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="fw-bold" style="color:var(--primary)">Détail de la matière première</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nom:</strong> <span id="voirNom"></span></p>
                <p><strong>Origine:</strong> <span id="voirOrigine"></span></p>
                <p><strong>Filière:</strong> <span id="voirFiliere"></span></p>
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
                    <h6 class="fw-bold" style="color:var(--primary)">Modifier la matière première</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nom</label>
                        <input type="text" class="form-control form-control-sm" name="nom" id="modNom" required>
                    </div>
                    <div class="mb-2">
                        <label>Origine</label>
                        <select class="form-select form-select-sm" name="origine" id="modOrigine" required>
                            <option value="locale">Locale</option>
                            <option value="importee">Importée</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Filière</label>
                        <input type="text" class="form-control form-control-sm" name="filiere" id="modFiliere" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function voirMatiere(data) {
        document.getElementById('voirNom').textContent = data.nom;
        document.getElementById('voirOrigine').textContent = data.origine === 'locale' ? 'Locale' : 'Importée';
        document.getElementById('voirFiliere').textContent = data.filiere;
    }
    function modifierMatiere(data) {
        document.getElementById('formModifier').action = '/matieres-premieres/' + data.id;
        document.getElementById('modNom').value = data.nom;
        document.getElementById('modOrigine').value = data.origine;
        document.getElementById('modFiliere').value = data.filiere;
    }
</script>
@endpush