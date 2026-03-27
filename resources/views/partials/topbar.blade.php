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
        <div class="position-relative">
            <a href="#" class="btn btn-light btn-sm rounded-circle p-2">
                <i class="bi bi-bell fs-5" style="color: var(--primary)"></i>
            </a>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                  style="background: var(--accent); font-size: 10px;">
                3
            </span>
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
                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Mon profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="#">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>