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
                <select class="form-select form-select-sm rounded-3">
                    <option value="">Tous les statuts</option>
                    <option>Validée</option>
                    <option>En attente</option>
                    <option>Rejetée</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Filière</label>
                <select class="form-select form-select-sm rounded-3">
                    <option value="">Toutes les filières</option>
                    <option>Agro-alimentaire</option>
                    <option>Textile</option>
                    <option>BTP</option>
                    <option>Agriculture</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Département</label>
                <select class="form-select form-select-sm rounded-3">
                    <option value="">Tous les départements</option>
                    <option>Littoral</option>
                    <option>Atlantique</option>
                    <option>Ouémé</option>
                    <option>Zou</option>
                    <option>Borgou</option>
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
                <input type="text" class="form-control form-control-sm rounded-3"
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
                    @php
                        $declarations = [
                            ['id'=>1, 'industriel'=>'SOBEBRA', 'filiere'=>'Agro-alimentaire', 'dept'=>'Littoral', 'trimestre'=>'T1 2025', 'date'=>'25/03/2025', 'statut'=>'Validée'],
                            ['id'=>2, 'industriel'=>'COTONOU TEXTILE', 'filiere'=>'Textile', 'dept'=>'Atlantique', 'trimestre'=>'T1 2025', 'date'=>'24/03/2025', 'statut'=>'En attente'],
                            ['id'=>3, 'industriel'=>'BÉNIN CIMENT', 'filiere'=>'BTP', 'dept'=>'Ouémé', 'trimestre'=>'T1 2025', 'date'=>'23/03/2025', 'statut'=>'Rejetée'],
                            ['id'=>4, 'industriel'=>'AGRO BÉNIN', 'filiere'=>'Agriculture', 'dept'=>'Zou', 'trimestre'=>'T1 2025', 'date'=>'22/03/2025', 'statut'=>'Validée'],
                            ['id'=>5, 'industriel'=>'SAPH BÉNIN', 'filiere'=>'Agro-alimentaire', 'dept'=>'Borgou', 'trimestre'=>'T1 2025', 'date'=>'21/03/2025', 'statut'=>'En attente'],
                            ['id'=>6, 'industriel'=>'TEXTILE NORD', 'filiere'=>'Textile', 'dept'=>'Atacora', 'trimestre'=>'T1 2025', 'date'=>'20/03/2025', 'statut'=>'En attente'],
                        ];
                    @endphp

                    @foreach($declarations as $d)
                    <tr>
                        <td style="font-size:13px; color:gray;">#{{ $d['id'] }}</td>
                        <td>
                            <div class="fw-semibold" style="font-size:14px;">{{ $d['industriel'] }}</div>
                        </td>
                        <td style="font-size:13px;">{{ $d['filiere'] }}</td>
                        <td style="font-size:13px;">{{ $d['dept'] }}</td>
                        <td style="font-size:13px;">{{ $d['trimestre'] }}</td>
                        <td style="font-size:13px;">{{ $d['date'] }}</td>
                        <td>
                            @if($d['statut'] === 'Validée')
                                <span class="badge rounded-pill bg-success">✓ Validée</span>
                            @elseif($d['statut'] === 'En attente')
                                <span class="badge rounded-pill bg-warning text-dark">⏳ En attente</span>
                            @else
                                <span class="badge rounded-pill bg-danger">✗ Rejetée</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('declarations.show', $d['id']) }}"
                                   class="btn btn-sm rounded-2"
                                   style="background:#e0f0ff; color:var(--primary); font-size:12px;"
                                   title="Voir détail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($d['statut'] === 'En attente')
                                <button class="btn btn-sm rounded-2"
                                        style="background:#dcfce7; color:#16a34a; font-size:12px;"
                                        title="Valider"
                                        onclick="ouvrirValider('{{ $d['industriel'] }}')"
                                        data-bs-toggle="modal" data-bs-target="#modalValider">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fee2e2; color:#dc2626; font-size:12px;"
                                        title="Rejeter"
                                        onclick="ouvrirRejeter('{{ $d['industriel'] }}')"
                                        data-bs-toggle="modal" data-bs-target="#modalRejeter">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">Affichage de 1 à 6 sur 248 déclarations</small>
            <nav>
                <ul class="pagination pagination-sm mb-0" id="maPagination">
                    <li class="page-item disabled">
                        <a class="page-link rounded-2" href="#">‹</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link rounded-2" href="#"
                           style="background:var(--primary); border-color:var(--primary); color:white;">1</a>
                    </li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">2</a></li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">3</a></li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">4</a></li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link rounded-2" href="#">›</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Modal Valider -->
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
                            <i class="bi bi-info-circle me-1"></i>
                            Vous êtes sur le point de valider la déclaration de
                            <strong id="nomIndustrielValider"></strong>.
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                            Commentaire (optionnel)
                        </label>
                        <textarea class="form-control rounded-3" rows="3"
                                  placeholder="Ajouter un commentaire..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:#16a34a; color:white;">
                        <i class="bi bi-check-lg me-1"></i> Confirmer la validation
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rejeter -->
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
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Vous êtes sur le point de rejeter la déclaration de
                            <strong id="nomIndustrielRejeter"></strong>.
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                            Motif du rejet <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control rounded-3" rows="3"
                                  placeholder="Expliquer la raison du rejet..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:#dc2626; color:white;">
                        <i class="bi bi-x-lg me-1"></i> Confirmer le rejet
                    </button>
                </div>
            </div>
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
                                <input class="form-check-input" type="radio" name="format" id="formatPDF" checked>
                                <label class="form-check-label" style="font-size:13px;" for="formatPDF">
                                    <i class="bi bi-file-earmark-pdf" style="color:#dc2626;"></i> PDF
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="format" id="formatExcel">
                                <label class="form-check-label" style="font-size:13px;" for="formatExcel">
                                    <i class="bi bi-file-earmark-excel" style="color:#16a34a;"></i> Excel
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Période</label>
                        <select class="form-select form-select-sm rounded-3">
                            <option>Toutes les déclarations</option>
                            <option>T1 2025</option>
                            <option>T4 2024</option>
                            <option>T3 2024</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Statut</label>
                        <select class="form-select form-select-sm rounded-3">
                            <option>Tous les statuts</option>
                            <option>Validée</option>
                            <option>En attente</option>
                            <option>Rejetée</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm rounded-3"
                            style="background:#f0f4f8; color:var(--primary);"
                            data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--secondary); color:white;">
                        <i class="bi bi-download me-1"></i> Télécharger
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

    // Pagination
    document.querySelectorAll('#maPagination .page-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('#maPagination .page-item').forEach(function(item) {
                item.classList.remove('active');
                var l = item.querySelector('.page-link');
                if(l) {
                    l.style.background = '';
                    l.style.borderColor = '';
                    l.style.color = '';
                }
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
    function filtrer() {
    var statut = document.querySelectorAll('select')[0].value;
    var filiere = document.querySelectorAll('select')[1].value;
    var dept = document.querySelectorAll('select')[2].value;

    var rows = document.querySelectorAll('tbody tr');
    rows.forEach(function(row) {
        var cells = row.querySelectorAll('td');
        var rowFiliere = cells[2].textContent.trim();
        var rowDept = cells[3].textContent.trim();
        var rowStatut = cells[6].textContent.trim();

        var matchStatut = !statut || rowStatut.includes(statut);
        var matchFiliere = !filiere || rowFiliere === filiere;
        var matchDept = !dept || rowDept === dept;

        row.style.display = (matchStatut && matchFiliere && matchDept) ? '' : 'none';
    });
}
</script>
@endpush