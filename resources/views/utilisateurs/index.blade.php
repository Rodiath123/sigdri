@extends('layouts.app')

@section('title', 'Utilisateurs')
@section('page-title', 'Utilisateurs')
@section('page-subtitle', 'Gestion des comptes et des rôles utilisateurs')

@section('content')

    <!-- Stats rapides -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Total utilisateurs</p>
                        <h3 class="fw-bold mb-0">{{ $users->total() }}</h3>
                    </div>
                    <i class="bi bi-people" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card orange">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Industriels</p>
                        <h3 class="fw-bold mb-0">{{ $users->where('role', 'industriel')->count() }}</h3>
                    </div>
                    <i class="bi bi-building" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card pink">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Agents</p>
                        <h3 class="fw-bold mb-0">{{ $users->where('role', 'agent')->count() }}</h3>
                    </div>
                    <i class="bi bi-person-badge" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card dark">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1" style="font-size:13px; opacity:0.8">Admins</p>
                        <h3 class="fw-bold mb-0">{{ $users->whereIn('role', ['super_admin', 'admin'])->count() }}</h3>
                    </div>
                    <i class="bi bi-shield-check" style="font-size:2.5rem; opacity:0.4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0" style="color:var(--primary)">
                <i class="bi bi-people me-2" style="color:var(--secondary)"></i>
                Liste des utilisateurs
            </h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm rounded-3" id="searchUser"
                       placeholder="🔍 Rechercher..." style="width:200px;">
                <button class="btn btn-sm rounded-3" style="background:var(--secondary); color:white;"
                        data-bs-toggle="modal" data-bs-target="#modalAjouter">
                    <i class="bi bi-plus-lg me-1"></i> Ajouter
                </button>
            </div>
        </div>

        <!-- Filtres rôles -->
        <div class="d-flex gap-2 mb-3">
            <a href="{{ route('utilisateurs.index') }}" class="btn btn-sm rounded-pill"
               style="background:var(--primary); color:white; font-size:12px; text-decoration:none;">
                Tous ({{ $users->total() }})
            </a>
            <a href="{{ route('utilisateurs.index', ['role' => 'industriel']) }}" class="btn btn-sm rounded-pill"
               style="background:#e0f0ff; color:var(--primary); font-size:12px; text-decoration:none;">
                Industriels ({{ $users->where('role', 'industriel')->count() }})
            </a>
            <a href="{{ route('utilisateurs.index', ['role' => 'agent']) }}" class="btn btn-sm rounded-pill"
               style="background:#fef3c7; color:#92400e; font-size:12px; text-decoration:none;">
                Agents ({{ $users->where('role', 'agent')->count() }})
            </a>
            <a href="{{ route('utilisateurs.index', ['role' => 'admin']) }}" class="btn btn-sm rounded-pill"
               style="background:#fee2e2; color:#dc2626; font-size:12px; text-decoration:none;">
                Admins ({{ $users->whereIn('role', ['super_admin', 'admin'])->count() }})
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background:#f0f4f8;">
                    <tr>
                        <th style="font-size:13px;">#</th>
                        <th style="font-size:13px;">Utilisateur</th>
                        <th style="font-size:13px;">Email</th>
                        <th style="font-size:13px;">Rôle</th>
                        <th style="font-size:13px;">Unité / Service</th>
                        <th style="font-size:13px;">Dernière connexion</th>
                        <th style="font-size:13px;">Statut</th>
                        <th style="font-size:13px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td style="font-size:13px; color:gray;">#{{ $u->id }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                     style="width:36px; height:36px; background:var(--primary); color:white; font-size:13px;">
                                    {{ strtoupper(substr($u->nom, 0, 1)) }}
                                </div>
                                <div class="fw-semibold" style="font-size:14px;">{{ $u->nom }}</div>
                            </div>
                        </td>
                        <td style="font-size:13px;">{{ $u->email }}</td>
                        <td>
                            @if($u->role === 'admin' || $u->role === 'super_admin')
                                <span class="badge rounded-pill" style="background:#fee2e2; color:#dc2626;">
                                    <i class="bi bi-shield-check me-1"></i>Admin
                                </span>
                            @elseif($u->role === 'agent')
                                <span class="badge rounded-pill" style="background:#fef3c7; color:#92400e;">
                                    <i class="bi bi-person-badge me-1"></i>Agent
                                </span>
                            @else
                                <span class="badge rounded-pill" style="background:#e0f0ff; color:var(--primary);">
                                    <i class="bi bi-building me-1"></i>Industriel
                                </span>
                            @endif
                        </td>
                        <td style="font-size:13px;">
                            {{ $u->uniteIndustrielle->nom ?? ($u->role === 'agent' || $u->role === 'admin' ? 'Ministère Industrie' : 'Non assigné') }}
                        </td>
                        <td style="font-size:13px; color:gray;">
                            {{ $u->dernier_connexion ? \Carbon\Carbon::parse($u->dernier_connexion)->diffForHumans() : 'Jamais' }}
                        </td>
                        <td>
                            @if($u->est_actif)
                                <span class="badge rounded-pill bg-success">● Actif</span>
                            @else
                                <span class="badge rounded-pill bg-secondary">● Inactif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm rounded-2"
                                        style="background:#e0f0ff; color:var(--primary); font-size:12px;"
                                        title="Voir profil"
                                        onclick='voirUser(@json($u))'
                                        data-bs-toggle="modal" data-bs-target="#modalVoir">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fef9c3; color:#854d0e; font-size:12px;"
                                        title="Modifier"
                                        onclick='modifierUser(@json($u))'
                                        data-bs-toggle="modal" data-bs-target="#modalModifier">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form method="POST" action="{{ route('utilisateurs.toggle', $u->id) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm rounded-2"
                                            style="background:#f0f4f8; color:gray; font-size:12px;"
                                            title="{{ $u->est_actif ? 'Désactiver' : 'Activer' }}">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </form>
                                <button class="btn btn-sm rounded-2"
                                        style="background:#fee2e2; color:#dc2626; font-size:12px;"
                                        title="Supprimer"
                                        onclick='supprimerUser(@json($u))'
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
            <small class="text-muted">Affichage de {{ $users->firstItem() }} à {{ $users->lastItem() }} sur {{ $users->total() }} utilisateurs</small>
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal Voir -->
    <div class="modal fade" id="modalVoir" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h6 class="fw-bold" style="color:var(--primary)">
                        <i class="bi bi-person me-2" style="color:var(--secondary)"></i>
                        Profil utilisateur
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold mx-auto"
                             style="width:60px; height:60px; background:var(--primary); color:white; font-size:24px;"
                             id="voirAvatar"></div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">NOM</label>
                            <p class="fw-bold mb-0" id="voirNom" style="color:var(--primary)"></p>
                        </div>
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">EMAIL</label>
                            <p class="fw-bold mb-0" id="voirEmail" style="color:var(--primary)"></p>
                        </div>
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">RÔLE</label>
                            <p class="fw-bold mb-0" id="voirRole" style="color:var(--primary)"></p>
                        </div>
                        <div class="col-6">
                            <label style="font-size:12px; color:gray;">UNITÉ</label>
                            <p class="fw-bold mb-0" id="voirUnite" style="color:var(--primary)"></p>
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
            <form id="formModifier" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content border-0 rounded-4">
                    <div class="modal-header border-0 pb-0">
                        <h6 class="fw-bold" style="color:var(--primary)">
                            <i class="bi bi-pencil me-2" style="color:#854d0e"></i>
                            Modifier l'utilisateur
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom complet</label>
                                <input type="text" class="form-control form-control-sm rounded-3" name="nom" id="modNom" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Email</label>
                                <input type="email" class="form-control form-control-sm rounded-3" name="email" id="modEmail" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Rôle</label>
                                <select class="form-select form-select-sm rounded-3" name="role" id="modRole" required>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="agent">Agent</option>
                                    <option value="industriel">Industriel</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Mot de passe</label>
                                <input type="password" class="form-control form-control-sm rounded-3" name="password" placeholder="Laisser vide pour ne pas changer">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-sm rounded-3"
                                style="background:#f0f4f8; color:var(--primary);"
                                data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold"
                                style="background:var(--primary); color:white;">
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
                            <i class="bi bi-trash me-2"></i> Supprimer l'utilisateur
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rounded-3 p-3" style="background:#fee2e2;">
                            <p class="mb-0" style="font-size:13px; color:#dc2626;">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                Voulez-vous vraiment supprimer l'utilisateur
                                <strong id="suppNom"></strong> ? Cette action est irréversible.
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-sm rounded-3"
                                style="background:#f0f4f8; color:var(--primary);"
                                data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold"
                                style="background:#dc2626; color:white;">
                            <i class="bi bi-trash me-1"></i> Confirmer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Ajouter -->
    <div class="modal fade" id="modalAjouter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('utilisateurs.store') }}">
                @csrf
                <div class="modal-content border-0 rounded-4">
                    <div class="modal-header border-0 pb-0">
                        <h6 class="fw-bold" style="color:var(--primary)">
                            <i class="bi bi-person-plus me-2" style="color:var(--secondary)"></i>
                            Ajouter un utilisateur
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Nom complet</label>
                                <input type="text" class="form-control form-control-sm rounded-3" name="nom" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Email</label>
                                <input type="email" class="form-control form-control-sm rounded-3" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Rôle</label>
                                <select class="form-select form-select-sm rounded-3" name="role" required>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="agent">Agent</option>
                                    <option value="industriel">Industriel</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:13px; color:var(--primary)">Mot de passe</label>
                                <input type="password" class="form-control form-control-sm rounded-3" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-sm rounded-3"
                                style="background:#f0f4f8; color:var(--primary);"
                                data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-sm rounded-3 fw-semibold"
                                style="background:var(--secondary); color:white;">
                            <i class="bi bi-person-plus me-1"></i> Ajouter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function voirUser(data) {
        document.getElementById('voirAvatar').textContent = data.nom.charAt(0).toUpperCase();
        document.getElementById('voirNom').textContent = data.nom;
        document.getElementById('voirEmail').textContent = data.email;
        
        let roleDisplay = data.role;
        if (data.role === 'super_admin') roleDisplay = 'Super Admin';
        else if (data.role === 'admin') roleDisplay = 'Admin';
        else if (data.role === 'agent') roleDisplay = 'Agent';
        else roleDisplay = 'Industriel';
        
        document.getElementById('voirRole').textContent = roleDisplay;
        document.getElementById('voirUnite').textContent = data.unite_industrielle?.nom || 'Ministère';
        document.getElementById('voirStatut').textContent = data.est_actif ? 'Actif' : 'Inactif';
    }

    function modifierUser(data) {
        document.getElementById('formModifier').action = '/utilisateurs/' + data.id;
        document.getElementById('modNom').value = data.nom;
        document.getElementById('modEmail').value = data.email;
        document.getElementById('modRole').value = data.role;
    }

    function supprimerUser(data) {
        document.getElementById('formSupprimer').action = '/utilisateurs/' + data.id;
        document.getElementById('suppNom').textContent = data.nom;
    }
</script>
@endpush