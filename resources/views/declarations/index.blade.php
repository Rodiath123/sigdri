@extends('layouts.app')

@section('title', 'Déclarations')
@section('page-title', 'Déclarations')
@section('page-subtitle', 'Gestion et validation des déclarations industrielles')

@section('content')

    <!-- Filtres -->
    <div class="card p-4 mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Statut</label>
                <select class="form-select form-select-sm rounded-3" id="filterStatut">
                    <option value="">Tous les statuts</option>
                    <option value="validee">Validée</option>
                    <option value="en_attente">En attente</option>
                    <option value="rejetee">Rejetée</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                <select class="form-select form-select-sm rounded-3" id="filterFiliere">
                    <option value="">Toutes les filières</option>
                    @php
                        use App\Models\UniteIndustrielle;
                        $filieres = UniteIndustrielle::select('filiere')->distinct()->get();
                    @endphp
                    @foreach($filieres as $f)
                        <option value="{{ $f->filiere }}">{{ $f->filiere }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                <select class="form-select form-select-sm rounded-3" id="filterDepartement">
                    <option value="">Tous les départements</option>
                    @php
                        $departements = UniteIndustrielle::select('departement')->distinct()->get();
                    @endphp
                    @foreach($departements as $d)
                        <option value="{{ $d->departement }}">{{ $d->departement }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-sm w-100 rounded-3" style="background:var(--primary); color:white;"
                   onclick="filtrer()">
                  <i class="bi bi-funnel me-1"></i> Filtrer
                </button>
            </div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color:var(--primary)">
                <i class="bi bi-file-earmark-text me-2" style="color:var(--secondary)"></i>
                Liste des déclarations
            </h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm rounded-3" id="searchInput"
                       placeholder="🔍 Rechercher..." style="width:200px;">
                <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;"
                        data-bs-toggle="modal" data-bs-target="#modalExporter">
                    <i class="bi bi-download me-1"></i> Exporter
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f0f4f8;">
                    <tr>
                        <th style="font-size:13px;">#</th>
                        <th style="font-size:13px;">Industriel</th>
                        <th style="font-size:13px;">Filière</th>
                        <th style="font-size:13px;">Département</th>
                        <th style="font-size:13px;">Trimestre</th>
                        <th style="font-size:13px;">Date soumission</th>
                        <th style="font-size:13px;">Statut</th>
                        <th style="font-size:13px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($declarations as $d)
                    <tr>
                        <td style="font-size:13px; color:gray;">#{{ $d->id }}</td>
                        <td>
                            <div class="fw-semibold" style="font-size:14px;">{{ $d->uniteIndustrielle->nom ?? 'N/A' }}</div>
                         </td>
                        <td style="font-size:13px;">{{ $d->uniteIndustrielle->filiere ?? 'N/A' }}</td>
                        <td style="font-size:13px;">{{ $d->uniteIndustrielle->departement ?? 'N/A' }}</td>
                        <td style="font-size:13px;">T{{ $d->trimestre }} {{ $d->annee }}</td>
                        <td style="font-size:13px;">{{ $d->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($d->statut === 'validee')
                                <span class="badge rounded-pill bg-success">✓ Validée</span>
                            @elseif($d->statut === 'en_attente')
                                <span class="badge rounded-pill bg-warning text-dark">⏳ En attente</span>
                            @else
                                <span class="badge rounded-pill bg-danger">✗ Rejetée</span>
                            @endif
                         </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('declarations.show', $d->id) }}"
                                   class="btn btn-sm rounded-2"
                                   style="background:#e0f0ff; color:var(--primary); font-size:12px;"
                                   title="Voir détail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($d->statut === 'en_attente')
                                <form method="POST" action="{{ route('declarations.valider', $d->id) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm rounded-2"
                                            style="background:#dcfce7; color:#16a34a; font-size:12px;"
                                            title="Valider">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fee2e2; color:#dc2626; font-size:12px;"
                                        title="Rejeter"
                                        onclick="ouvrirRejeter('{{ $d->id }}', '{{ $d->uniteIndustrielle->nom ?? '' }}')"
                                        data-bs-toggle="modal" data-bs-target="#modalRejeter">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                @endif
                            </div>
                         </td>
                     </tr>
                    @empty
                     <tr>
                        <td colspan="8" class="text-center">Aucune déclaration trouvée</td>
                     </tr>
                    @endforelse
                </tbody>
             </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Affichage de {{ $declarations->firstItem() ?? 0 }} à {{ $declarations->lastItem() ?? 0 }} sur {{ $declarations->total() ?? 0 }} déclarations</small>
            {{ $declarations->links() }}
        </div>
    </div>

    <!-- Modal Valider (version dynamique) -->
    <div class="modal fade" id="modalValider" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formValider" method="POST">
                @csrf
                @method('PATCH')
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
                                <i class="bi bi-info-circle me-1"></i>
                                Vous êtes sur le point de valider la déclaration de
                                <strong id="nomIndustrielValider"></strong>.
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                                Commentaire (optionnel)
                            </label>
                            <textarea name="commentaire" class="form-control rounded-3" rows="3"
                                      placeholder="Ajouter un commentaire..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-sm rounded-3"
                                style="background:#f0f4f8; color:var(--primary);"
                                data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold"
                                style="background:#16a34a; color:white;">
                            <i class="bi bi-check-lg me-1"></i> Confirmer la validation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Rejeter -->
    <div class="modal fade" id="modalRejeter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formRejeter" method="POST">
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
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                Vous êtes sur le point de rejeter la déclaration de
                                <strong id="nomIndustrielRejeter"></strong>.
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                                Motif du rejet <span class="text-danger">*</span>
                            </label>
                            <textarea name="commentaire_rejet" class="form-control rounded-3" rows="3"
                                      placeholder="Expliquer la raison du rejet..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-sm rounded-3"
                                style="background:#f0f4f8; color:var(--primary);"
                                data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold"
                                style="background:#dc2626; color:white;">
                            <i class="bi bi-x-lg me-1"></i> Confirmer le rejet
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Exporter -->
    <div class="modal fade" id="modalExporter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-download me-2" style="color:var(--secondary)"></i>
                        Exporter les déclarations
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                            Format d'export
                        </label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="format" id="formatPDF" value="pdf" checked>
                                <label class="form-check-label" style="font-size:13px;" for="formatPDF">
                                    <i class="bi bi-file-earmark-pdf" style="color:#dc2626;"></i> PDF
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="format" id="formatExcel" value="excel">
                                <label class="form-check-label" style="font-size:13px;" for="formatExcel">
                                    <i class="bi bi-file-earmark-excel" style="color:#16a34a;"></i> Excel
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Période</label>
                        <select class="form-select form-select-sm rounded-3" id="exportPeriode">
                            <option value="all">Toutes les déclarations</option>
                            <option value="2025">Année 2025</option>
                            <option value="2024">Année 2024</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Statut</label>
                        <select class="form-select form-select-sm rounded-3" id="exportStatut">
                            <option value="">Tous les statuts</option>
                            <option value="validee">Validée</option>
                            <option value="en_attente">En attente</option>
                            <option value="rejetee">Rejetée</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--secondary); color:white;" onclick="exporter()">
                        <i class="bi bi-download me-1"></i> Télécharger
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function ouvrirValider(id, nom) {
        document.getElementById('formValider').action = '/declarations/' + id + '/valider';
        document.getElementById('nomIndustrielValider').textContent = nom;
    }

    function ouvrirRejeter(id, nom) {
        document.getElementById('formRejeter').action = '/declarations/' + id + '/rejeter';
        document.getElementById('nomIndustrielRejeter').textContent = nom;
    }

    function filtrer() {
        var statut = document.getElementById('filterStatut').value;
        var filiere = document.getElementById('filterFiliere').value;
        var dept = document.getElementById('filterDepartement').value;
        var search = document.getElementById('searchInput').value.toLowerCase();

        var rows = document.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            if(row.querySelector('td') && row.querySelector('td').getAttribute('colspan') !== '8') {
                var cells = row.querySelectorAll('td');
                var rowFiliere = cells[2]?.textContent.trim() || '';
                var rowDept = cells[3]?.textContent.trim() || '';
                var rowStatut = cells[6]?.textContent.trim() || '';
                var rowIndustriel = cells[1]?.textContent.trim() || '';

                var matchStatut = !statut || 
                    (statut === 'validee' && rowStatut.includes('Validée')) ||
                    (statut === 'en_attente' && rowStatut.includes('En attente')) ||
                    (statut === 'rejetee' && rowStatut.includes('Rejetée'));
                var matchFiliere = !filiere || rowFiliere === filiere;
                var matchDept = !dept || rowDept === dept;
                var matchSearch = !search || rowIndustriel.toLowerCase().includes(search);

                row.style.display = (matchStatut && matchFiliere && matchDept && matchSearch) ? '' : 'none';
            }
        });
    }

    document.getElementById('searchInput').addEventListener('keyup', filtrer);
    document.getElementById('filterStatut').addEventListener('change', filtrer);
    document.getElementById('filterFiliere').addEventListener('change', filtrer);
    document.getElementById('filterDepartement').addEventListener('change', filtrer);

    function exporter() {
        var format = document.querySelector('input[name="format"]:checked').value;
        var periode = document.getElementById('exportPeriode').value;
        var statut = document.getElementById('exportStatut').value;
        window.location.href = '/rapports/generate-' + format + '?periode=' + periode + '&statut=' + statut;
    }
</script>
@endpush