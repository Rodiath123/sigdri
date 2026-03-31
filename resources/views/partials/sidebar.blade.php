<div id="sidebar">
    <!-- Logo -->
    <div class="logo">
        <h4><i class="bi bi-building-gear"></i> SIGDRI</h4>
        <span>Ministère de l'Industrie</span>
    </div>

    <!-- Menu -->
    <nav class="mt-3">
        <p class="section-title">Principal</p>

        <a href="{{ route('dashboard') }}" 
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>

        <p class="section-title">Gestion</p>

        <a href="{{ route('declarations.index') }}" 
           class="nav-link {{ request()->routeIs('declarations.index') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i> Déclarations
        </a>

        <a href="{{ route('unites.index') }}" 
           class="nav-link {{ request()->routeIs('unites.index') ? 'active' : '' }}">
            <i class="bi bi-buildings"></i> Unités industrielles
        </a>

        <a href="{{ route('produits.index') }}" 
           class="nav-link {{ request()->routeIs('produits.index') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Produits & Matières
        </a>

        <p class="section-title">Rapports</p>

        <a href="{{ route('statistiques.index') }}" 
           class="nav-link {{ request()->routeIs('statistiques.index') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i> Statistiques
        </a>

        <a href="{{ route('rapports.index') }}" 
           class="nav-link {{ request()->routeIs('rapports.index') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-pdf"></i> Rapports PDF/Excel
        </a>

        <a href="{{ route('alertes.index') }}" 
           class="nav-link {{ request()->routeIs('alertes.index') ? 'active' : '' }}">
            <i class="bi bi-bell"></i> Alertes
        </a>

        <p class="section-title">Administration</p>

        <a href="{{ route('utilisateurs.index') }}" 
           class="nav-link {{ request()->routeIs('utilisateurs.index') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Utilisateurs
        </a>

        <a href="{{ route('parametrage.index') }}" 
           class="nav-link {{ request()->routeIs('parametrage.index') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Paramètres
        </a>
    </nav>
</div>