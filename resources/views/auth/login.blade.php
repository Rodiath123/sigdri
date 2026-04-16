@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
<div class="auth-card">

    <!-- Header -->
    <div class="auth-header">
        <h3><i class="bi bi-building-gear"></i> SIGDRI</h3>
        <p>Ministère de l'Industrie du Bénin</p>
    </div>

    <!-- Body -->
    <div class="auth-body">
        <h5 class="fw-bold mb-1" style="color: var(--primary)">Bon retour 👋</h5>
        <p class="text-muted mb-4" style="font-size: 13px">Connectez-vous à votre espace</p>

        @if(session('error'))
            <div class="alert alert-danger rounded-3" style="font-size: 13px">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Adresse email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="exemple@ministere.bj" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="text-danger mt-1" style="font-size: 12px">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label class="form-label">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="••••••••" required>
                    <button type="button" class="btn btn-outline-secondary border-start-0"
                            style="border-radius: 0 10px 10px 0; border: 2px solid #e5e7eb; border-left: none;"
                            onclick="togglePassword()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger mt-1" style="font-size: 12px">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bouton -->
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
            </button>
        </form>
    </div>

    <!-- Footer -->
    <div class="auth-footer">
        <i class="bi bi-shield-lock me-1"></i>
        Accès réservé aux agents autorisés
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword() {
        const pwd = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            pwd.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endpush