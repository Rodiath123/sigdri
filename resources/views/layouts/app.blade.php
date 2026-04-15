<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGDRI - @yield('title')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary:   #1a3a5c;
            --secondary: #f97316;
            --accent:    #f43f8e;
            --light:     #f8f9fa;
            --dark:      #111827;
        }

        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', sans-serif;
        }

        /* SIDEBAR */
        #sidebar {
    width: 260px;
    height: 100vh;
    background: var(--primary);
    position: fixed;
    top: 0; left: 0;
    z-index: 1000;
    transition: all 0.3s;
    overflow-y: auto;
}

#sidebar::-webkit-scrollbar {
    width: 4px;
}

#sidebar::-webkit-scrollbar-track {
    background: transparent;
}

#sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.2);
    border-radius: 10px;
}

        #sidebar .logo {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        #sidebar .logo h4 {
            color: var(--secondary);
            font-weight: 800;
            margin: 0;
        }

        #sidebar .logo span {
            color: white;
            font-size: 12px;
        }

        #sidebar .nav-link {
            color: rgba(255,255,255,0.75);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.2s;
            font-size: 14px;
        }

        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: var(--secondary);
            color: white;
        }

        #sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }

        #sidebar .section-title {
            color: rgba(255,255,255,0.4);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 20px 5px;
        }

        /* TOPBAR */
        #topbar {
            margin-left: 260px;
            background: white;
            padding: 12px 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* CONTENU PRINCIPAL */
        #main-content {
            margin-left: 260px;
            padding: 25px;
            min-height: 100vh;
        }

        /* CARDS */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }

        .stat-card {
            border-radius: 12px;
            padding: 20px;
            color: white;
        }

        .stat-card.blue   { background: linear-gradient(135deg, #1a3a5c, #2563eb); }
        .stat-card.orange { background: linear-gradient(135deg, #f97316, #ea580c); }
        .stat-card.pink   { background: linear-gradient(135deg, #f43f8e, #db2777); }
        .stat-card.dark   { background: linear-gradient(135deg, #111827, #374151); }

        .badge-role {
            background: var(--secondary);
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- SIDEBAR --}}
    @include('partials.sidebar')

    {{-- TOPBAR --}}
    @include('partials.topbar')

    {{-- CONTENU --}}
    <div id="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>