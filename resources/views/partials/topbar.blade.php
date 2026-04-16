<div id="topbar">
    <!-- Titre de la page -->
    <div>
        <h5 class="mb-0 fw-bold" style="color: var(--primary)">
            @yield('page-title', 'Dashboard')
        </h5>
        <small class="text-muted">@yield('page-subtitle', 'Tableau de bord général')</small>
    </div>

    <!-- Droite : notifications + profil -->
    <div class="d-flex align-items-center gap-3">

        <!-- Notifications -->
        @php
            use App\Models\AlerteMP;
            
            $alertesNonTraitees = AlerteMP::with(['uniteIndustrielle', 'matierePremiere'])
                ->where('est_traitee', false)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            
            $totalAlertes = AlerteMP::where('est_traitee', false)->count();
        @endphp

        <div class="dropdown">
            <a href="#" class="btn btn-light btn-sm rounded-circle p-2 position-relative"
               data-bs-toggle="dropdown">
                <i class="bi bi-bell fs-5" style="color: var(--primary)"></i>
                @if($totalAlertes > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                          style="background: var(--accent); font-size: 10px;">{{ $totalAlertes }}</span>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" style="width:320px;">
                <li>
                    <h6 class="fw-bold px-2 mb-2" style="color:var(--primary); font-size:13px;">
                        <i class="bi bi-bell me-1"></i> Alertes ({{ $totalAlertes }})
                    </h6>
                </li>
                @forelse($alertesNonTraitees as $alerte)
                <li>
                    <a class="dropdown-item rounded-2 py-2" href="{{ route('alertes.index') }}">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:35px; height:35px; {{ $alerte->statut === 'rupture' ? 'background:#fee2e2;' : 'background:#fef3c7;' }}">
                                <i class="bi {{ $alerte->statut === 'rupture' ? 'bi-x-circle' : 'bi-exclamation-triangle' }}" 
                                   style="color: {{ $alerte->statut === 'rupture' ? '#dc2626' : '#92400e' }}; font-size:14px;"></i>
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:600;">
                                    {{ $alerte->statut === 'rupture' ? 'Rupture' : 'Tension' }} - {{ $alerte->matierePremiere->nom ?? 'N/A' }}
                                </div>
                                <div style="font-size:11px; color:gray;">
                                    {{ $alerte->uniteIndustrielle->nom ?? 'N/A' }} - {{ $alerte->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                @empty
                <li>
                    <div class="dropdown-item text-center py-2" style="font-size:13px; color:gray;">
                        <i class="bi bi-check-circle me-1"></i> Aucune alerte
                    </div>
                </li>
                @endforelse
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-center rounded-2 py-1"
                       href="{{ route('alertes.index') }}"
                       style="font-size:13px; color:var(--primary);">
                        Voir toutes les alertes →
                    </a>
                </li>
            </ul>
        </div>

        <!-- Profil -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:38px; height:38px; background: var(--primary); color: white; font-weight: bold;">
                    {{ strtoupper(substr(Auth::user()->nom ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <div class="fw-semibold" style="font-size: 14px; color: var(--dark)">{{ Auth::user()->nom ?? 'Admin' }}</div>
                    <div style="font-size: 11px; color: gray;">{{ ucfirst(Auth::user()->role ?? 'Administrateur') }}</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li>
                    <a class="dropdown-item py-2" href="{{ route('profil.index') }}">
                        <i class="bi bi-person me-2" style="color:var(--primary)"></i>Mon profil
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="{{ route('parametrage.index') }}">
                        <i class="bi bi-gear me-2" style="color:var(--primary)"></i>Paramètres
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 text-danger" 
                                style="background: none; border: none; width: 100%; text-align: left;">
                            <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>