@extends('layouts.app')

@section('title', 'Alertes')
@section('page-title', 'Alertes')
@section('page-subtitle', 'Suivi des tensions et ruptures de matières premières')

@section('content')

    <!-- Stats rapides -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Total alertes</p>
                        <h3 class="fw-bold mb-0">17</h3>
                        <small style="opacity:0.7">Ce mois</small>
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
                        <h3 class="fw-bold mb-0">11</h3>
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
                        <h3 class="fw-bold mb-0">6</h3>
                        <small style="opacity:0.7">Critique</small>
                    </div>
                    <i class="bi bi-x-circle" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
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
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm rounded-3" style="width:160px;">
                    <option>Tous les types</option>
                    <option>Tension</option>
                    <option>Rupture</option>
                </select>
                <select class="form-select form-select-sm rounded-3" style="width:160px;">
                    <option>Toutes les filières</option>
                    <option>Agro-alimentaire</option>
                    <option>Textile</option>
                    <option>BTP</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f0f4f8;">
                    <tr>
                        <th style="font-size:13px;">#</th>
                        <th style="font-size:13px;">Matière première</th>
                        <th style="font-size:13px;">Filière</th>
                        <th style="font-size:13px;">Département</th>
                        <th style="font-size:13px;">Industriel concerné</th>
                        <th style="font-size:13px;">Type</th>
                        <th style="font-size:13px;">Date signalement</th>
                        <th style="font-size:13px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $alertes = [
                            ['id'=>1, 'matiere'=>'Soja', 'filiere'=>'Agro-alimentaire', 'dept'=>'Littoral', 'industriel'=>'SOBEBRA', 'type'=>'Tension', 'date'=>'26/03/2025'],
                            ['id'=>2, 'matiere'=>'Ciment gris', 'filiere'=>'BTP', 'dept'=>'Ouémé', 'industriel'=>'BÉNIN CIMENT', 'type'=>'Rupture', 'date'=>'25/03/2025'],
                            ['id'=>3, 'matiere'=>'Blé dur', 'filiere'=>'Agro-alimentaire', 'dept'=>'Atlantique', 'industriel'=>'AGRO BÉNIN', 'type'=>'Tension', 'date'=>'24/03/2025'],
                            ['id'=>4, 'matiere'=>'Coton brut', 'filiere'=>'Textile', 'dept'=>'Borgou', 'industriel'=>'TEXTILE NORD', 'type'=>'Rupture', 'date'=>'23/03/2025'],
                            ['id'=>5, 'matiere'=>'Huile de palme', 'filiere'=>'Agriculture', 'dept'=>'Zou', 'industriel'=>'SAPH BÉNIN', 'type'=>'Tension', 'date'=>'22/03/2025'],
                            ['id'=>6, 'matiere'=>'Sucre', 'filiere'=>'Agro-alimentaire', 'dept'=>'Littoral', 'industriel'=>'SOBEBRA', 'type'=>'Rupture', 'date'=>'21/03/2025'],
                        ];
                    @endphp

                    @foreach($alertes as $a)
                    <tr>
                        <td style="font-size:13px; color:gray;">#{{ $a['id'] }}</td>
                        <td class="fw-semibold" style="font-size:14px;">{{ $a['matiere'] }}</td>
                        <td style="font-size:13px;">{{ $a['filiere'] }}</td>
                        <td style="font-size:13px;">{{ $a['dept'] }}</td>
                        <td style="font-size:13px;">{{ $a['industriel'] }}</td>
                        <td>
                            @if($a['type'] === 'Tension')
                                <span class="badge rounded-pill bg-warning text-dark">
                                    <i class="bi bi-exclamation-triangle me-1"></i>Tension
                                </span>
                            @else
                                <span class="badge rounded-pill bg-danger">
                                    <i class="bi bi-x-circle me-1"></i>Rupture
                                </span>
                            @endif
                        </td>
                        <td style="font-size:13px;">{{ $a['date'] }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm rounded-2"
                                        style="background:#e0f0ff; color:var(--primary); font-size:12px;"
                                        title="Voir détail"
                                        onclick="voirAlerte('{{ $a['matiere'] }}', '{{ $a['filiere'] }}', '{{ $a['dept'] }}', '{{ $a['industriel'] }}', '{{ $a['type'] }}', '{{ $a['date'] }}')"
                                        data-bs-toggle="modal" data-bs-target="#modalVoir">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#dcfce7; color:#16a34a; font-size:12px;"
                                        title="Marquer comme résolu"
                                        onclick="resoudreAlerte('{{ $a['matiere'] }}')"
                                        data-bs-toggle="modal" data-bs-target="#modalResoudre">
                                    <i class="bi bi-check-lg"></i>
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
            <small class="text-muted">Affichage de 1 à 6 sur 17 alertes</small>
            <nav>
                <ul class="pagination pagination-sm mb-0" id="paginationAlertes">
                    <li class="page-item disabled"><a class="page-link rounded-2" href="#">‹</a></li>
                    <li class="page-item active">
                        <a class="page-link rounded-2" href="#"
                           style="background:var(--primary); border-color:var(--primary); color:white;">1</a>
                    </li>
                    <li class="page-item"><a class="page-link rounded-2" href="#">2</a></li>
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

    <!-- Modal Résoudre -->
    <div class="modal fade" id="modalResoudre" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:#16a34a">
                        <i class="bi bi-check-circle me-2"></i>
                        Marquer comme résolu
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="rounded-3 p-3 mb-3" style="background:#dcfce7;">
                        <p class="mb-0" style="font-size:13px; color:#16a34a;">
                            <i class="bi bi-info-circle me-1"></i>
                            Marquer l'alerte sur <strong id="resoudreNom"></strong> comme résolue ?
                        </p>
                    </div>
                    <div>
                        <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                            Note de résolution (optionnel)
                        </label>
                        <textarea class="form-control rounded-3" rows="3"
                                  placeholder="Décrire comment le problème a été résolu..."></textarea>
                    </div>
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

@endsection

@push('scripts')
<script>
    function voirAlerte(matiere, filiere, dept, industriel, type, date) {
        document.getElementById('voirMatiere').textContent = matiere;
        document.getElementById('voirFiliere').textContent = filiere;
        document.getElementById('voirDept').textContent = dept;
        document.getElementById('voirIndustriel').textContent = industriel;
        document.getElementById('voirType').textContent = type;
        document.getElementById('voirDate').textContent = date;
    }

    function resoudreAlerte(nom) {
        document.getElementById('resoudreNom').textContent = nom;
    }

    // Pagination
    document.querySelectorAll('#paginationAlertes .page-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('#paginationAlertes .page-item').forEach(function(item) {
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