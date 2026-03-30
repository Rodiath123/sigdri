@extends('layouts.app')

@section('title', 'Produits & Matières premières')
@section('page-title', 'Produits & Matières premières')
@section('page-subtitle', 'Gestion des catalogues produits et matières premières')

@section('content')

    <!-- Onglets -->
    <ul class="nav nav-pills mb-4 gap-2" id="produitsTabs">
    <li class="nav-item">
        <button class="nav-link active rounded-3 fw-semibold" id="tab-produits"
           style="background:var(--primary); color:white; font-size:13px; border:none;">
            <i class="bi bi-box-seam me-1"></i> Produits
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link rounded-3 fw-semibold" id="tab-matieres"
           style="background:#f0f4f8; color:var(--primary); font-size:13px; border:none;">
            <i class="bi bi-basket me-1"></i> Matières premières
        </button>
    </li>
</ul>
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
                    <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;">
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
                    <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;">
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

@endsection

@push('scripts')
<script>
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
</script>
@endpush