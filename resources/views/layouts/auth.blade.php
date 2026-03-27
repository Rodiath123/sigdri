<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGDRI - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1a3a5c;
            --secondary: #f97316;
            --accent: #f43f8e;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a3a5c 0%, #2563eb 50%, #1a3a5c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
        }

        .auth-header {
            background: linear-gradient(135deg, var(--primary), #2563eb);
            padding: 35px;
            text-align: center;
        }

        .auth-header h3 {
            color: var(--secondary);
            font-weight: 800;
            font-size: 28px;
            margin: 0;
        }

        .auth-header p {
            color: rgba(255,255,255,0.8);
            margin: 5px 0 0;
            font-size: 13px;
        }

        .auth-body {
            padding: 35px;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary);
            font-size: 14px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(249,115,22,0.15);
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 2px solid #e5e7eb;
            border-right: none;
            background: #f8f9fa;
            color: var(--primary);
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--secondary), #ea580c);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 13px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(249,115,22,0.4);
            color: white;
        }

        .auth-footer {
            text-align: center;
            padding: 0 35px 30px;
            font-size: 12px;
            color: gray;
        }
    </style>

    @stack('styles')
</head>
<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>