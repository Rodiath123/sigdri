@extends('layouts.app')

@section('title', 'Paramétrage')
@section('page-title', 'Paramétrage')
@section('page-subtitle', 'Configuration des filières, départements et paramètres système')

@section('content')

    <!-- Onglets -->
    <div class="d-flex gap-2 mb-4">
        <button class="btn btn-sm rounded-3 fw-semibold" id="tab-filieres"
                style="background:var(--primary); color:white; font-size:13px;">
            <i class="bi bi-diagram-3 me-1"></i> Filières
        </button>
        <button class="btn btn-sm rounded-3 fw-semibold" id="tab-departements"
                style="background:#f0f4f8; color:var(--primary); font-size:13px;">
            <i class="bi bi-geo-alt me-1"></i> Départements
        </button>
        <button class="btn btn-sm rounded-3 fw-semibold" id="tab-systeme"
                style="background:#f0f4f8; color:var(--primary); font-size:13px;">
            <i class="bi bi-gear me-1"></i> Système
        </button>
    </div>

    <!-- Section Filières -->
    <div id="section-filieres">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0" style="color:var(--primary)">
                    <i class="bi bi-diagram-3 me-2" style="color:var(--secondary)"></i>
                    Gestion des filières
                </h6>
                <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;">
                    <i class="bi bi-plus-lg me-1"></i> Ajouter
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead style="background:#f0f4f8;">
                        <tr>
                            <th style="font-size:13px;">#</th>
                            <th style="font-size:13px;">Nom de la filière</th>
                            <th style="font-size:13px;">Code</th>
                            <th style="font-size:13px;">Nb unités</th>
                            <th style="font-size:13px;">Statut</th>
                            <th style="font-size:13px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $filieres = [
                                ['id'=>1, 'nom'=>'Agro-alimentaire', 'code'=>'AGR', 'unites'=>120, 'statut'=>'Active'],
                                ['id'=>2, 'nom'=>'Textile', 'code'=>'TEX', 'unites'=>85, 'statut'=>'Active'],
                                ['id'=>3, 'nom'=>'BTP', 'code'=>'BTP', 'unites'=>67, 'statut'=>'Active'],
                                ['id'=>4, 'nom'=>'Agriculture', 'code'=>'AGRI', 'unites'=>45, 'statut'=>'Active'],
                                ['id'=>5, 'nom'=>'Chimie', 'code'=>'CHM', 'unites'=>25, 'statut'=>'Inactive'],
                            ];
                        @endphp

                        @foreach($filieres as $f)
                        <tr>
                            <td style="font-size:13px; color:gray;">#{{ $f['id'] }}</td>
                            <td class="fw-semibold" style="font-size:14px;">{{ $f['nom'] }}</td>
                            <td>
                                <span class="badge rounded-pill"
                                      style="background:#e0f0ff; color:var(--primary); font-size:12px;">
                                    {{ $f['code'] }}
                                </span>
                            </td>
                            <td style="font-size:13px;">{{ $f['unites'] }} unités</td>
                            <td>
                                @if($f['statut'] === 'Active')
                                    <span class="badge rounded-pill bg-success">● Active</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary">● Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm rounded-2"
                                            style="background:#fef9c3; color:#854d0e; font-size:12px;">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm rounded-2"
                                            style="background:#fee2e2; color:#dc2626; font-size:12px;">
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

    <!-- Section Départements -->
    <div id="section-departements" style="display:none;">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0" style="color:var(--primary)">
                    <i class="bi bi-geo-alt me-2" style="color:var(--secondary)"></i>
                    Gestion des départements
                </h6>
                <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;">
                    <i class="bi bi-plus-lg me-1"></i> Ajouter
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead style="background:#f0f4f8;">
                        <tr>
                            <th style="font-size:13px;">#</th>
                            <th style="font-size:13px;">Département</th>
                            <th style="font-size:13px;">Chef-lieu</th>
                            <th style="font-size:13px;">Nb unités</th>
                            <th style="font-size:13px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $departements = [
                                ['id'=>1, 'nom'=>'Littoral', 'chef'=>'Cotonou', 'unites'=>98],
                                ['id'=>2, 'nom'=>'Atlantique', 'chef'=>'Ouidah', 'unites'=>72],
                                ['id'=>3, 'nom'=>'Ouémé', 'chef'=>'Porto-Novo', 'unites'=>65],
                                ['id'=>4, 'nom'=>'Borgou', 'chef'=>'Parakou', 'unites'=>48],
                                ['id'=>5, 'nom'=>'Zou', 'chef'=>'Abomey', 'unites'=>35],
                                ['id'=>6, 'nom'=>'Atacora', 'chef'=>'Natitingou', 'unites'=>24],
                            ];
                        @endphp

                        @foreach($departements as $d)
                        <tr>
                            <td style="font-size:13px; color:gray;">#{{ $d['id'] }}</td>
                            <td class="fw-semibold" style="font-size:14px;">{{ $d['nom'] }}</td>
                            <td style="font-size:13px;">{{ $d['chef'] }}</td>
                            <td style="font-size:13px;">{{ $d['unites'] }} unités</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm rounded-2"
                                            style="background:#fef9c3; color:#854d0e; font-size:12px;">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm rounded-2"
                                            style="background:#fee2e2; color:#dc2626; font-size:12px;">
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

    <!-- Section Système -->
    <div id="section-systeme" style="display:none;">
        <div class="card p-4">
            <h6 class="fw-bold mb-4" style="color:var(--primary)">
                <i class="bi bi-gear me-2" style="color:var(--secondary)"></i>
                Paramètres système
            </h6>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                        Nom de l'application
                    </label>
                    <input type="text" class="form-control form-control-sm rounded-3" value="SIGDRI">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                        Email de contact
                    </label>
                    <input type="email" class="form-control form-control-sm rounded-3"
                           value="contact@ministere-industrie.bj">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                        Délai de déclaration (jours)
                    </label>
                    <input type="number" class="form-control form-control-sm rounded-3" value="30">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">
                        Langue par défaut
                    </label>
                    <select class="form-select form-select-sm rounded-3">
                        <option selected>Français</option>
                        <option>English</option>
                    </select>
                </div>
                <div class="col-12">
                    <button class="btn btn-sm rounded-3 fw-semibold"
                            style="background:var(--primary); color:white;">
                        <i class="bi bi-save me-1"></i> Enregistrer les paramètres
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    const tabs = ['filieres', 'departements', 'systeme'];

    tabs.forEach(tab => {
        document.getElementById('tab-' + tab).onclick = function() {
            tabs.forEach(t => {
                document.getElementById('section-' + t).style.display = 'none';
                document.getElementById('tab-' + t).style.background = '#f0f4f8';
                document.getElementById('tab-' + t).style.color = 'var(--primary)';
            });
            document.getElementById('section-' + tab).style.display = 'block';
            this.style.background = 'var(--primary)';
            this.style.color = 'white';
        };
    });
</script>
@endpush