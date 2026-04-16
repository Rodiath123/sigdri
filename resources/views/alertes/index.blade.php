@extends('layouts.app')

@section('title', 'Alertes')
@section('page-title', 'Alertes')
@section('page-subtitle', 'Suivi des tensions et ruptures de matières premières')

@section('content')

@php
    use App\Models\AlerteMP;
    use App\Models\MatierePremiere;
    use App\Models\UniteIndustrielle;
    
    // Statistiques réelles
    $totalAlertes = AlerteMP::count();
    $tensionsCount = AlerteMP::where('statut', 'tension')->count();
    $rupturesCount = AlerteMP::where('statut', 'rupture')->count();
    
    // Liste des alertes
    $alertes = AlerteMP::with(['uniteIndustrielle', 'matierePremiere'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    
    // Filières pour les filtres
    $filieres = UniteIndustrielle::select('filiere')
        ->whereNotNull('filiere')
        ->distinct()
        ->pluck('filiere');
    
    // Départements pour les filtres
    $departements = UniteIndustrielle::select('departement')
        ->whereNotNull('departement')
        ->distinct()
        ->pluck('departement');
@endphp

<!-- Stats rapides -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card blue">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Total alertes</p>
                    <h3 class="fw-bold mb-0">{{ $totalAlertes }}</h3>
                    <small style="opacity:0.7">Enregistrées</small>
                </div>
                <i class="bi bi-bell" style="font-size:2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card orange">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Tensions</p>
                    <h3 class="fw-bold mb-0">{{ $tensionsCount }}</h3>
                    <small style="opacity:0.7">En cours</small>
                </div>
                <i class="bi bi-exclamation-triangle" style="font-size:2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card pink">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1" style="font-size:13px; opacity:0.8">Ruptures</p>
                    <h3 class="fw-bold mb-0">{{ $rupturesCount }}</h3>
                    <small style="opacity:0.7">Critique</small>
                </div>
                <i class="bi bi-x-circle" style="font-size:2.5rem; opacity:0.4"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filtres -->
<div class="card p-3 mb-4">
    <div class="row g-3">
        <div class="col-md-3">
            <label class="form-label fw-semibold" style="font-size:12px;">Type d'alerte</label>
            <select class="form-select form-select-sm" id="filterType">
                <option value="">Tous les types</option>
                <option value="tension">Tension</option>
                <option value="rupture">Rupture</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold" style="font-size:12px;">Filière</label>
            <select class="form-select form-select-sm" id="filterFiliere">
                <option value="">Toutes les filières</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere }}">{{ $filiere }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold" style="font-size:12px;">Département</label>
            <select class="form-select form-select-sm" id="filterDept">
                <option value="">Tous les départements</option>
                @foreach($departements as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold" style="font-size:12px;">Statut</label>
            <select class="form-select form-select-sm" id="filterTraitee">
                <option value="">Tous</option>
                <option value="0">Non traitée</option>
                <option value="1">Traitée</option>
            </select>
        </div>
    </div>
</div>

<!-- Tableau alertes -->
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0" style="color:var(--primary)">
            <i class="bi bi-bell me-2" style="color:var(--secondary)"></i>
            Liste des alertes
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead style="background:#f0f4f8;">
                <tr>
                    <th style="font-size:13px;">#</th>
                    <th style="font-size:13px;">Matière première</th>
                    <th style="font-size:13px;">Filière</th>
                    <th style="font-size:13px;">Département</th>
                    <th style="font-size:13px;">Industriel</th>
                    <th style="font-size:13px;">Type</th>
                    <th style="font-size:13px;">Date signalement</th>
                    <th style="font-size:13px;">Statut</th>
                    <th style="font-size:13px;">Actions</th>
                </tr>
            </thead>
            <tbody id="alertesTableBody">
                @forelse($alertes as $a)
                <tr data-id="{{ $a->id }}" data-statut="{{ $a->statut }}" data-filiere="{{ $a->uniteIndustrielle->filiere ?? '' }}" data-dept="{{ $a->uniteIndustrielle->departement ?? '' }}" data-traitee="{{ $a->est_traitee }}">
                    <td style="font-size:13px; color:gray;">#{{ $a->id }}</td>
                    <td class="fw-semibold" style="font-size:14px;">{{ $a->matierePremiere->nom ?? 'N/A' }}</td>
                    <td style="font-size:13px;">{{ $a->uniteIndustrielle->filiere ?? 'N/A' }}</td>
                    <td style="font-size:13px;">{{ $a->uniteIndustrielle->departement ?? 'N/A' }}</td>
                    <td style="font-size:13px;">{{ $a->uniteIndustrielle->nom ?? 'N/A' }}</td>
                    <td>
                        @if($a->statut === 'tension')
                            <span class="badge rounded-pill bg-warning text-dark">
                                <i class="bi bi-exclamation-triangle me-1"></i>Tension
                            </span>
                        @elseif($a->statut === 'rupture')
                            <span class="badge rounded-pill bg-danger">
                                <i class="bi bi-x-circle me-1"></i>Rupture
                            </span>
                        @else
                            <span class="badge rounded-pill bg-success">
                                <i class="bi bi-check-circle me-1"></i>Disponible
                            </span>
                        @endif
                    </td>
                    <td style="font-size:13px;">{{ $a->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($a->est_traitee)
                            <span class="badge bg-secondary">✓ Traitée</span>
                        @else
                            <span class="badge bg-warning text-dark">⏳ En cours</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm rounded-2"
                                    style="background:#e0f0ff; color:var(--primary);"
                                    onclick='voirAlerte(@json($a))'
                                    data-bs-toggle="modal" data-bs-target="#modalVoir">
                                <i class="bi bi-eye"></i>
                            </button>
                            @if(!$a->est_traitee)
                            <form method="POST" action="{{ route('alertes.traiter', $a->id) }}" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm rounded-2"
                                        style="background:#dcfce7; color:#16a34a;"
                                        title="Marquer comme traitée">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Aucune alerte pour le moment</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <small class="text-muted">Affichage de {{ $alertes->firstItem() ?? 0 }} à {{ $alertes->lastItem() ?? 0 }} sur {{ $alertes->total() ?? 0 }} alertes</small>
        {{ $alertes->links() }}
    </div>
</div>

<!-- Modal Voir -->
<div class="modal fade" id="modalVoir" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="fw-bold" style="color:var(--primary)">
                    <i class="bi bi-bell me-2" style="color:var(--secondary)"></i>
                    Détail de l'alerte
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <label style="font-size:12px; color:gray;">MATIÈRE PREMIÈRE</label>
                        <p class="fw-bold mb-0" id="voirMatiere" style="color:var(--primary)"></p>
                    </div>
                    <div class="col-6">
                        <label style="font-size:12px; color:gray;">TYPE</label>
                        <p class="fw-bold mb-0" id="voirType" style="color:var(--primary)"></p>
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
                        <label style="font-size:12px; color:gray;">INDUSTRIEL</label>
                        <p class="fw-bold mb-0" id="voirIndustriel" style="color:var(--primary)"></p>
                    </div>
                    <div class="col-6">
                        <label style="font-size:12px; color:gray;">DATE</label>
                        <p class="fw-bold mb-0" id="voirDate" style="color:var(--primary)"></p>
                    </div>
                    <div class="col-12">
                        <label style="font-size:12px; color:gray;">COMMENTAIRE</label>
                        <p class="mb-0" id="voirCommentaire" style="color:var(--primary)"></p>
                    </div>
                    <div class="col-12">
                        <label style="font-size:12px; color:gray;">STATUT</label>
                        <p class="mb-0" id="voirStatut" style="color:var(--primary)"></p>
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

@endsection

@push('scripts')
<script>
    function voirAlerte(data) {
        document.getElementById('voirMatiere').textContent = data.matiere_premiere?.nom || 'N/A';
        document.getElementById('voirType').textContent = data.statut === 'tension' ? 'Tension' : (data.statut === 'rupture' ? 'Rupture' : 'Disponible');
        document.getElementById('voirFiliere').textContent = data.unite_industrielle?.filiere || 'N/A';
        document.getElementById('voirDept').textContent = data.unite_industrielle?.departement || 'N/A';
        document.getElementById('voirIndustriel').textContent = data.unite_industrielle?.nom || 'N/A';
        document.getElementById('voirDate').textContent = new Date(data.created_at).toLocaleDateString('fr-FR');
        document.getElementById('voirCommentaire').textContent = data.commentaire || 'Aucun commentaire';
        document.getElementById('voirStatut').innerHTML = data.est_traitee ? 
            '<span class="badge bg-secondary">✓ Traitée</span>' : 
            '<span class="badge bg-warning text-dark">⏳ En cours de traitement</span>';
    }

    // Filtres
    document.getElementById('filterType').addEventListener('change', filtrer);
    document.getElementById('filterFiliere').addEventListener('change', filtrer);
    document.getElementById('filterDept').addEventListener('change', filtrer);
    document.getElementById('filterTraitee').addEventListener('change', filtrer);

    function filtrer() {
        var type = document.getElementById('filterType').value;
        var filiere = document.getElementById('filterFiliere').value;
        var dept = document.getElementById('filterDept').value;
        var traitee = document.getElementById('filterTraitee').value;
        
        var rows = document.querySelectorAll('#alertesTableBody tr');
        
        rows.forEach(function(row) {
            if(row.querySelector('td') && row.querySelector('td').getAttribute('colspan') !== '9') {
                var rowType = row.getAttribute('data-statut');
                var rowFiliere = row.getAttribute('data-filiere');
                var rowDept = row.getAttribute('data-dept');
                var rowTraitee = row.getAttribute('data-traitee');
                
                var matchType = !type || rowType === type;
                var matchFiliere = !filiere || rowFiliere === filiere;
                var matchDept = !dept || rowDept === dept;
                var matchTraitee = traitee === '' || rowTraitee === traitee;
                
                row.style.display = (matchType && matchFiliere && matchDept && matchTraitee) ? '' : 'none';
            }
        });
    }
</script>
@endpush