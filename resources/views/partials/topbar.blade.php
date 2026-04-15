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
        <div class="dropdown">
            <a href="#" class="btn btn-light btn-sm rounded-circle p-2 position-relative"
               data-bs-toggle="dropdown">
                <i class="bi bi-bell fs-5" style="color: var(--primary)"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                      style="background: var(--accent); font-size: 10px;">3</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" style="width:300px;">
                <li>
                    <h6 class="fw-bold px-2 mb-2" style="color:var(--primary); font-size:13px;">
                        <i class="bi bi-bell me-1"></i> Notifications (3)
                    </h6>
                </li>
                <li>
                    <a class="dropdown-item rounded-2 py-2" href="#">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:35px; height:35px; background:#fee2e2;">
                                <i class="bi bi-x-circle" style="color:#dc2626; font-size:14px;"></i>
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:600;">Rupture - Ciment gris</div>
                                <div style="font-size:11px; color:gray;">Il y a 2 heures</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item rounded-2 py-2" href="#">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:35px; height:35px; background:#fef3c7;">
                                <i class="bi bi-exclamation-triangle" style="color:#92400e; font-size:14px;"></i>
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:600;">Tension - Soja</div>
                                <div style="font-size:11px; color:gray;">Il y a 5 heures</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item rounded-2 py-2" href="#">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:35px; height:35px; background:#dcfce7;">
                                <i class="bi bi-check-circle" style="color:#16a34a; font-size:14px;"></i>
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:600;">Déclaration validée - SOBEBRA</div>
                                <div style="font-size:11px; color:gray;">Hier à 14h30</div>
                            </div>
                        </div>
                    </a>
                </li>
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
                    A
                </div>
                <div>
                    <div class="fw-semibold" style="font-size: 14px; color: var(--dark)">Admin</div>
                    <div style="font-size: 11px; color: gray;">Administrateur</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li>
                    <a class="dropdown-item py-2" href="{{ route('profil') }}">
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
                    <a class="dropdown-item py-2 text-danger" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>