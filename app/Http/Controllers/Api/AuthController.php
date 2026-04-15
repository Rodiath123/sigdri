<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Connexion
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants sont incorrects.'],
            ]);
        }

        if (!$user->est_actif) {
            return response()->json([
                'message' => 'Votre compte est désactivé. Contactez l\'administrateur.'
            ], 403);
        }

        // Mise à jour dernière connexion
        $user->update(['dernier_connexion' => now()]);

        // Log de connexion
        UserLog::create([
            'user_id' => $user->id,
            'action'  => 'connexion',
            'ip_address' => $request->ip(),
        ]);

        $token = $user->createToken('sigdri-token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie.',
            'token'   => $token,
            'user'    => [
                'id'    => $user->id,
                'nom'   => $user->nom,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ]);
    }

    // Déconnexion
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        UserLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'deconnexion',
            'ip_address' => $request->ip(),
        ]);

        return response()->json(['message' => 'Déconnexion réussie.']);
    }

    // Profil utilisateur connecté
    public function me(Request $request)
    {
        return response()->json($request->user()->load('uniteIndustrielle'));
    }

    // Inscription industriel (en attente de validation)
    public function register(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nom'       => $request->nom,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'industriel',
            'est_actif' => false, // En attente de validation admin
        ]);

        return response()->json([
            'message' => 'Inscription réussie. Votre compte est en attente de validation.',
            'user'    => $user,
        ], 201);
    }
}